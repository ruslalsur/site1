<?php


namespace app\commands;


use yii\console\Controller;

class RbacController extends Controller
{
    public function actionIndex()
    {
        \Yii::$app->rbac->genRbac();
        echo 'ok' . PHP_EOL;
    }
}