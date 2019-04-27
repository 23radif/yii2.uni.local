<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%users}}`.
 */
class m190423_095959_create_users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%users}}', [
            'id' => $this->primaryKey(),
            'login' => $this->string(50)->notNull(),
            'password' => $this->string(20)->notNull(),
            'email' => $this->string(),
            'regDate' => $this->date(),
        ]);

        $this->insert('users', [
            'login' => 'admin',
            'password' => 'admin',
        ]);

        $this->insert('users', [
            'login' => 'demo',
            'password' => 'demo',
        ]);

        /*$this->addForeignKey(
            "fk_task_creator_user", "task", "creator_id", "users", "id");
        $this->addForeignKey(
            "fk_task_responsible_user", "task", "responsible_id", "users", "id");*/
    }


    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%users}}');
    }
}
