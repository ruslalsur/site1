<?php


namespace app\components;


use app\models\ActivityModel;
use app\rules\OwnerActivityRule;
use Yii;
use yii\base\Component;

class RbacComponent extends Component
{
    public function getAuthManager()
    {
        return Yii::$app->authManager;
    }

    public function genRbac()
    {
        $authManager = $this->getAuthManager();
        $authManager->removeAll();

        $roleAdmin = $authManager->createRole('admin');
        $roleAdmin->description = 'Роль админа';
        $authManager->add($roleAdmin);

        $roleUser = $authManager->createRole('user');
        $roleUser->description = 'Роль пользователя';
        $authManager->add($roleUser);

        $createActivityPermission = $authManager->createPermission('createActivityPermission');
        $createActivityPermission->description = 'Разрешение на создание активности';
        $authManager->add($createActivityPermission);

        $editActivityOwnerPermission = $authManager->createPermission('editActivityOwnerPermission');
        $editActivityOwnerPermission->description = 'Разрешение на редактирование своей активности';
        $rule = new OwnerActivityRule();
        $editActivityOwnerPermission->ruleName = $rule->name;
        $authManager->add($rule);
        $authManager->add($editActivityOwnerPermission);

        $editActivityAllPermission = $authManager->createPermission('editActivityAllPermission');
        $editActivityAllPermission->description = 'Разрешение на редактирование любой активности ';
        $authManager->add($editActivityAllPermission);

        $authManager->addChild($roleUser, $createActivityPermission);
        $authManager->addChild($roleUser, $editActivityOwnerPermission);
        $authManager->addChild($roleAdmin, $roleUser);
        $authManager->addChild($roleAdmin, $editActivityAllPermission);

        $authManager->assign($roleAdmin, 1);
//        $authManager->assign($roleUser, 4);
    }

    public function assignmentUserRole($id)
    {
        $authManager = $this->getAuthManager();
        $authManager->assign($authManager->getRole('user'), $id);
    }

    public function canCreateActivity(): bool
    {
        return Yii::$app->user->can('createActivityPermission');
    }

    public function canEditActivity(ActivityModel $activity)
    {
        if (Yii::$app->user->can('editActivityAllPermission')) {
            return true;
        }

        if (Yii::$app->user->can('editActivityOwnerPermission', ['activity' => $activity])) {
            return true;
        }
        return false;
    }
}