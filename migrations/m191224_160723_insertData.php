<?php

use yii\db\Migration;

/**
 * Class m191224_160723_insertData
 */
class m191224_160723_insertData extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('users',[
            'id' => 1,
            'email' => 'user1@mail.ru',
            'password_hash' => \Yii::$app->security->generatePasswordHash('123456')
        ]);

        $this->insert('users',[
            'id' => 2,
            'email' => 'user2@mail.ru',
            'password_hash' => \Yii::$app->security->generatePasswordHash('123456')
        ]);

        $this->batchInsert('activity', ['title', 'user_id', 'deadline', 'userNotification', 'email'], [
            ['title 1', 1, date('Y-m-d'), 0, null],
            ['title 2', 2, date('Y-m-d'), 0, null],
            ['title 3', 2, date('Y-m-d'), 1, 'example3@email.com'],
            ['title 4', 2, date('Y-m-d'), 1, 'example@email.com'],
            ['title 5', 1, '2017-09-14', 1, 'example2@email.com'],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('users');
        $this->delete('activity');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191224_160723_insertData cannot be reverted.\n";

        return false;
    }
    */
}
