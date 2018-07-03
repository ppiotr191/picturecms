<?php

use yii\db\Migration;

/**
 * Handles the creation of table `rating_comments`.
 */
class m180625_153041_create_rating_comments_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('rating_comments', [
            'id' => $this->primaryKey(),
            'author_id' => $this->integer(),
            'comment_id' => $this->integer(),
            'rate' => $this->tinyInteger()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('rating_comments');
    }
}
