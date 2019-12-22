<?php

use yii\db\Migration;

/**
 * Class m191222_154927_create_tables
 */
class m191222_154927_create_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('activity', [
            'id' => $this->primaryKey(),
            'title' => $this->string(150)->notNull(),
            'description' => $this->text(),
            'deadline' =>  $this->date()->notNull(),
            'isBlocked' => $this->tinyInteger()->notNull()->defaultValue(0),
            'email' => $this->string(150),
            'userNotification' => $this->tinyInteger()->notNull()->defaultValue(0),
            'createAt' =>$this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP')
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
       $this->dropTable('activity');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191222_154927_create_tables cannot be reverted.\n";

        return false;
    }
    */
}
