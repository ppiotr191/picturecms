<?php

use yii\db\Migration;
use yii\db\oci\Schema;

/**
 * Handles the creation of table `pictures`.
 */
class m180622_205657_create_pictures_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('pictures', [
            'id' => $this->primaryKey(),
            'name' => Schema::TYPE_STRING,
            'author_id' => $this->integer()->notNull(),
            'file_id' => $this->integer()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('pictures');
    }
}
