<?php


namespace app\behaviors;


use yii\base\Behavior;

class DateCreateBehavior extends Behavior
{
    public string $attributeName;

    public function getDateCreated() {
        $date = $this->owner->{$this->attributeName};

        return \Yii::$app->formatter->asDatetime($date, 'php: d.m.Y H:i:s');
    }

}