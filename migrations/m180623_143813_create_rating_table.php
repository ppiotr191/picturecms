<?php

use yii\db\Migration;

/**
 * Handles the creation of table `rating`.
 */
class m180623_143813_create_rating_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('rating', [
            'id' => $this->primaryKey(),
            'author_id' => $this->integer(),
            'picture_id' => $this->integer(),
            'rate' => $this->tinyInteger()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('rating');
    }
}
