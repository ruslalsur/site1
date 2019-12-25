<?php

use yii\db\Migration;

/**
 * Class m191224_152517_alterTable
 */
class m191224_152517_alterTable extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('activity', 'user_id', $this->integer()->notNull());
        $this->addForeignKey('activityFK', 'activity', 'user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->createIndex('user_email_index', 'users', 'email', true);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('activityFK', 'activity');
        $this->dropColumn('activity', 'user_id');
        $this->dropIndex('user_email_index', 'activity');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191224_152517_alterTable cannot be reverted.\n";

        return false;
    }
    */
}
