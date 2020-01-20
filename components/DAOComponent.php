<?php


namespace app\components;


use app\base\BaseController;
use yii\base\Component;
use yii\db\Connection;
use yii\db\Exception;
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

    public function insertActivityIntoDb(&$model, $tableDb)
    {
        $this->getConnection()->createCommand()->insert($tableDb, [
            'title' => $model->title,
            'description' => $model->description,
            'deadline' => $model->deadline,
            'isBlocked' => $model->isBlocked,
            'email' => $model->email,
            'userNotification' => $model->userNotification,
            'user_id' => \Yii::$app->user->getId(),
            'createAt' => date('Y-m-d')])
            ->execute();

        $model->id=$this->getConnection()->lastInsertID;
    }

    public function getCountActivities() {
        $qBuilder = new Query();

        return $qBuilder->from('activity')
            ->select('count(id)')
            ->scalar();
    }

    public function transactionTest() {
        //автоиатический откат или завершение транзакции
        $this->getConnection()->transaction(function() {
            $this->getConnection()->createCommand()->insert('activity',
                ['title' => 'title' . mt_rand(100, 1000),
                    'user_id' => 1,
                    'deadline' => date('Y-m-d')])->execute();

//            throw new \Exception();

            $this->getConnection()->createCommand()->insert('activity',
                ['title' => 'title' . mt_rand(100, 1000),
                    'user_id' => 1,
                    'deadline' => date('Y-m-d')])->execute();
        });

        //ручной откат илм завершение транзакции
        $transaction = $this->getConnection()->beginTransaction();
        try {
            $this->getConnection()->createCommand()->insert('activity',
                ['title' => 'title' . mt_rand(100, 1000),
                    'user_id' => 1,
                    'deadline' => date('Y-m-d')])->execute();

//            throw new \Exception();

            $this->getConnection()->createCommand()->insert('activity',
                ['title' => 'title' . mt_rand(100, 1000),
                    'user_id' => 1,
                    'deadline' => date('Y-m-d')])->execute();

            $transaction->commit();

        } catch (\Exception $e) {
            $transaction->rollBack();
        }
    }

    public function getActivitiesReader() {
        $queryBuilder = new Query();
        return $queryBuilder->from('activity')->createCommand()->query();
    }
}