<?php

use yii\db\Migration;

/**
 * Handles the creation of table `files_`.
 */
class m180622_220424_create_files_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('files', [
            'id' => $this->primaryKey(),
            'url' => $this->string(),
            'create_date' => $this->dateTime()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('files_');
    }
}
