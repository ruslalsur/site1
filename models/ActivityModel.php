<?php


namespace app\models;


use yii\base\Model;

class ActivityModel extends Model
{
    public $title;
    public $description;
    public $dateStart;
    public $isBlocked;

    public function rules()
    {
        return [
            ['title', 'required'],
            ['description', 'string', 'min' => 5],
            ['isBlocked', 'boolean']
        ];
    }


}