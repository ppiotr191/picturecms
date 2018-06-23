<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Handles the creation of table `users`.
 */
class m180522_185713_create_users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('users', [
            'id' => $this->primaryKey(),
            'email' => Schema::TYPE_STRING,
            'password' => Schema::TYPE_STRING,
            'auth_key' => Schema::TYPE_STRING,
            'active' => Schema::TYPE_STRING,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('users');
    }
}
