<?php


namespace app\models\my_validators;


use yii\validators\Validator;

class MyTitleValidator extends Validator
{
    public $exceptionList;

    public function validateAttribute($model, $attribute)
    {
        if (in_array($model->$attribute, $this->exceptionList)) {
            $model->addError($attribute, 'Запрещенное название');
        }
    }
}