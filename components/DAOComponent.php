<?php


namespace app\components;


use app\base\BaseController;
use yii\base\Component;
use yii\db\Connection;

class DAOComponent extends Component
{
    private function getConnection(): Connection {
        return \Yii::$app->db;
    }

    public function getUsers() {
        $sql = 'select * from users';
        return $this->getConnection()->createCommand($sql)->queryAll();
    }

    public function getUserActivities($user) {
        $sql = "select * from activity where user_id = :user";
        return $this->getConnection()->createCommand($sql, [':user' => $user])->queryAll();
    }

}