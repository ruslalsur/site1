<?php


namespace app\models;


use app\models\my_validators\MyTitleValidator;
use yii\base\Model;

class ActivityModel extends Model
{
    public $title;
    public $description;
    public $deadline;
    public $isBlocked;
    public $email;
    public $emailRepeat;
    public $userNotification;
    public $iteratorType;
    public $files;
    const REPEAT_TYPE = [
        0 => 'ежежневно',
        1 => 'еженежельно'
    ];

    public function beforeValidate()
    {
        $date = \DateTime::createFromFormat('d.m.Y', $this->deadline);
        if ($date) {
            $this->deadline = $date->format('Y-m-d');
        }

        return parent::beforeValidate();
    }

    public function rules()
    {
        return [
            [['title', 'email'], 'trim'],
            [['title', 'deadline'], 'required', 'message' => 'переопределенное сообщение  об ошибке'],
            ['deadline', 'date', 'format' => 'php:Y-m-d'],
            ['description', 'string', 'min' => 5],
            [['isBlocked', 'userNotification'], 'boolean'],
            ['email', 'email'],
            ['email', 'required', 'when' => function (ActivityModel $activity_model) {
                return $activity_model->userNotification ? true : false;
            }],
            ['emailRepeat', 'compare', 'compareAttribute' => 'email'],
            ['iteratorType', 'in', 'range' => array_keys(self::REPEAT_TYPE)],
//            ['title', 'myValidateFunction'],
            ['title', MyTitleValidator::class, 'exceptionList' => ['admin', 'админ', 'шаурма']],
            ['title', 'match', 'pattern' => '/([A-Za-z-]+)/', 'message' => 'только буквы'],
            ['files', 'file', 'extensions' => ['jpg', 'png'], 'maxFiles' => 4],
        ];
    }

//    public function myValidateFunction($attr) {
//        if ($this->title === 'admin') {
//            $this->addError('title', 'Запрещенное название');
//        }
//    }

    public function attributeLabels()
    {
        return [
            'title' => 'Заголовок',
            'description' => 'Описание',
            'deadline' => 'Смертельная черта',
            'isBlocked' => 'Целый день'
        ];
    }


}