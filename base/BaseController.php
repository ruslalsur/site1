<?php


namespace app\base;


use yii\web\Controller;

class BaseController extends Controller
{
    public function beforeAction($action)
    {
        \Yii::warning($action->id);
        return parent::beforeAction($action);
    }


}