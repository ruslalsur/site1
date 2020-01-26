<?php


namespace app\widgets\daoUserWidget;


use yii\base\Widget;

class DaoUserWidget extends Widget
{
    public $user;

    public function init() {
        parent::init();

        if (empty($this->user)) {
            throw new \Exception('param user required');
        }
    }

    public function run()
    {
        return $this->render('index', ['users'=>$this->user]);

    }

}