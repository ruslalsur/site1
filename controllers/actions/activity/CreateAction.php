<?php


namespace app\controllers\actions\activity;


use yii\base\Action;

class CreateAction extends Action
{
    public $classEntity;

    public function run() {
        $activityModel = new $this->classEntity;
        $activityModel->title = 'Заголовок из CreateAction';

        if (\Yii::$app->request->isPost) {
            $activityModel->load(\Yii::$app->request->post());

            if (\Yii::$app->activity->createActivity($activityModel)) {
                return $this->controller->redirect('/');
            }
        }

        return $this->controller->render('create-view', ['model' => $activityModel]);
    }

}