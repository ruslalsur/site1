<?php


namespace app\components;


use app\base\BaseController;
use yii\base\Component;
use yii\db\Connection;
use yii\db\Query;

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

    public function getFirstActivity() {
        $queryBuilder = new Query();

        return $queryBuilder->from('activity')
            ->orderBy(['id' => SORT_DESC])
            ->select(['id', 'title'])
            ->andwhere(['userNotification' => 1])
            ->limit(3)
//            ->createCommand()->rawSql; (SELECT `id`, `title` FROM `activity` WHERE `userNotification`=1 ORDER BY `id` DESC LIMIT 3 )
            ->one();
    }

    public function getCountActivities() {
        $qBuilder = new Query();

        return $qBuilder->from('activity')
            ->select('count(id)')
            ->scalar();
    }

}