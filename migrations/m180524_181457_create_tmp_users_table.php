<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Handles the creation of table `tmp_users`.
 */
class m180524_181457_create_tmp_users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('tmp_users', [
            'id' => $this->primaryKey(),
            'email' => Schema::TYPE_STRING,
            'password' => Schema::TYPE_STRING,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('tmp_users');
    }
}
