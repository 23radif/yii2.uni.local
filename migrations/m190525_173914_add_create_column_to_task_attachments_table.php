<?php

use yii\db\Migration;

//Миграцию сделал как пример добавления новых столбцов в таблицу, в других столбцы create_time и update_time добавлялись вручную
/**
 * Handles adding create to table `{{%task_attachments}}`.
 */
class m190525_173914_add_create_column_to_task_attachments_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('task_attachments', 'create_time', $this->dateTime());
        $this->addColumn('task_attachments', 'update_time', $this->dateTime());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('task_attachments', 'create_time');
        $this->dropColumn('task_attachments', 'update_time');
    }
}
