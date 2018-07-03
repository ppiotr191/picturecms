<?php

use yii\db\Migration;

/**
 * Handles the creation of table `comments`.
 */
class m180625_152850_create_comments_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('comments', [
            'id' => $this->primaryKey(),
            'author_id' => $this->integer()->notNull(),
            'content' => $this->string(255),
            'picture_id' => $this->integer()->notNull(),
            'parent_id' => $this->integer()->null(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('comments');
    }
}
