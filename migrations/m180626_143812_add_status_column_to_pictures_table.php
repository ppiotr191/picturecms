<?php

use yii\db\Migration;

/**
 * Handles adding status to table `pictures`.
 */
class m180626_143812_add_status_column_to_pictures_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('pictures', 'status', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('pictures','status');
    }
}
