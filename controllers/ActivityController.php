<?php


namespace app\controllers;


use app\base\BaseController;
use app\controllers\actions\activity\CreateAction;
use app\models\ActivityModel;

class ActivityController extends BaseController
{
//    public function actionCreate()
//    {
//        //создание экземпляра модели
//        $activityModel = new ActivityModel();
//
//        //загрузка данных в модель
//        $activityModel->title = 'Заголовок из CreateAction';
//
//        if (\Yii::$app->request->isPost) {
//            //множественная загрузка
//            $activityModel->load(\Yii::$app->request->post());
//        }
//
//        if ($activityModel->validate()) {
//            return $this->render('create-view', ['model' => $activityModel]);
//        }
//        return false;
//    }

    public function actions()
    {
        return [
            'create' => ['class' => CreateAction::class, 'classEntity' => ActivityModel::class]
        ];
    }
}