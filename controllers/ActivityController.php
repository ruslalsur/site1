<?php


namespace app\controllers;


use app\base\BaseController;
use app\components\ActivityComponent;
use app\controllers\actions\activity\CreateAction;
use app\models\ActivityModel;

class ActivityController extends BaseController
{
    public function actionCreate() {
//        $activityModel = new ActivityModel();
//        $activityModel = \Yii::$app->activity->getEntity();

        //создание компонента динамически
        $activityComponent = \Yii::createObject(['class' => ActivityComponent::class,
            'classEntity' => ActivityModel::class]);
        $activityModel = $activityComponent->getEntity();


        $activityModel->title = 'Заголовок из CreateAction';

        if (\Yii::$app->request->isPost) {
            $activityModel->load(\Yii::$app->request->post());

            if (\Yii::$app->activity->createActivity($activityModel)) {
                return $this->redirect('/');
            }
        }

        return $this->render('create-view', ['model' => $activityModel]);
    }

//    public function actions()
//    {
//        return [
//            'create' => ['class' => CreateAction::class, 'classEntity' => ActivityModel::class]
//        ];
//    }
}