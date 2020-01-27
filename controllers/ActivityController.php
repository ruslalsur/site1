<?php


namespace app\controllers;


use app\base\BaseController;
use app\controllers\actions\activity\CreateAction;
use app\controllers\actions\activity\ViewAction;
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
            'create' => ['class' => CreateAction::class, 'classEntity' => ActivityModel::class],
            'view' => ['class' => ViewAction::class]
        ];
    }

    public function actionEdit($id)
    {
        /** @var ActivityModel $activity */
        $activity = \Yii::$app->activityComp->getActivityById($id);

        if (!$activity) {
            throw new \HttpException(404, 'activity bot found');
        }

        if (\Yii::$app->request->isPost) {
            $activity->load(\Yii::$app->request->post());
            if (\Yii::$app->activityComp->editActivity($activity)) {
                return $this->redirect(['/activity/view', 'id' => $activity->id]);
            }
        }
        $this->layout = 'auth';

        return $this->render('edit', ['model' => $activity]);
    }
}