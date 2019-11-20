<?php


namespace app\controllers;


use app\base\BaseController;
use app\controllers\actions\activity\CreateAction;
use app\models\ActivityModel;

class ActivityController extends BaseController
{
    public function actionCreate() {
        $activityModel = new ActivityModel();
        if (\Yii::$app->request->isPost) {
            $activityModel->load(\Yii::$app->request->post());
        }

        if ($activityModel->validate()) {

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