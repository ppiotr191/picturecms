<?php

use yii\db\Migration;

/**
 * Class m180626_225609_add_dates
 */
class m180626_225609_add_dates extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('tmp_users', 'create_date', $this->dateTime());
        $this->addColumn('users', 'create_date', $this->dateTime());
        $this->addColumn('users', 'register_date', $this->dateTime());
        $this->addColumn('pictures', 'create_date', $this->dateTime());
        $this->addColumn('rating', 'create_date', $this->dateTime());
        $this->addColumn('rating_comments', 'create_date', $this->dateTime());
        $this->addColumn('comments', 'create_date', $this->dateTime());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('tmp_users', 'create_date');
        $this->dropColumn('users', 'create_date');
        $this->dropColumn('users', 'register_date');
        $this->dropColumn('pictures', 'create_date');
        $this->dropColumn('rating', 'create_date');
        $this->dropColumn('rating_comments', 'create_date');
        $this->dropColumn('comments', 'create_date');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180626_225609_add_dates cannot be reverted.\n";

        return false;
    }
    */
}
