<?php


namespace app\controllers;


use app\base\BaseController;

class DaoController extends BaseController
{
    public function actionIndex() {
        $dao = \Yii::$app->dao;

        $users = $dao->getUsers();
        $userActivities = $dao->getUserActivities(\Yii::$app->request->get('user', 1));

        return $this->render('index', ['users' => $users, 'activities' => $userActivities]);

    }

}