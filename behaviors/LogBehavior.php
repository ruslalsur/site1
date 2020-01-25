<?php


namespace app\behaviors;


use app\components\ActivityComponent;
use yii\base\Behavior;
use yii\db\ActiveRecord;

class LogBehavior extends Behavior
{
    public function events()
    {
        return [
            ActiveRecord::EVENT_BEFORE_INSERT => 'LogIt',
            ActivityComponent::EVENT_CUSTOM => 'LogIt'
        ];
    }

    public function logIt()
    {
        \Yii::warning('this log from behavior');
    }

}