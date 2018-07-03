<?php

use yii\db\Migration;

/**
 * Class m180630_200509_ban_table
 */
class m180630_200509_ban_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('bans', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'create_date' => $this->dateTime(),
            'finish_date' => $this->dateTime(),
            'reason' => $this->string(255),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('bans');
    }

}
