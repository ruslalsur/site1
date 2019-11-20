<?php


namespace app\controllers\actions\activity;


use yii\base\Action;

class CreateAction extends Action
{
    public $classEntity;

    public function run() {
        $activityModel = new $this->classEntity;
        $activityModel->title = 'Заголовок из CreateAction';

        return $this->controller->render('create-view', ['model' => $activityModel]);
    }

}