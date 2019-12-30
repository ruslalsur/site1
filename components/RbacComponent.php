<?php


namespace app\components;


use yii\base\Component;

class RbacComponent extends Component
{
    public function getAuthManager()
    {
        return \Yii::$app->authManager;
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

        $createActivityPermission = $authManager->createPermission('createActivity');
        $createActivityPermission->description = 'Разрешение на создание активности';
        $authManager->add($createActivityPermission);

        $editActivityOwnerPermission = $authManager->createPermission('editActivityOwnerPermission');
        $editActivityOwnerPermission->description = 'Разрешение на редактирование своей активности';
        $authManager->add($editActivityOwnerPermission);

        $editActivityAllPermission = $authManager->createPermission('editActivityAllPermission');
        $editActivityAllPermission->description = 'Разрешение на редактирование любой активности ';
        $authManager->add($editActivityAllPermission);

        $authManager->addChild($roleUser, $createActivityPermission);
        $authManager->addChild($roleUser, $editActivityOwnerPermission);
        $authManager->addChild($roleAdmin, $roleUser);
        $authManager->addChild($roleAdmin, $editActivityAllPermission);

        $authManager->assign($roleAdmin, 3);
        $authManager->assign($roleUser, 4);
    }

    public function canCreateActivity(): bool {
        return \Yii::$app->user->can('createActivity');
    }
}