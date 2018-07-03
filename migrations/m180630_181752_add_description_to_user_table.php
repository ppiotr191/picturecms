<?php

use yii\db\Migration;

/**
 * Class m180630_181752_add_description_to_user_table
 */
class m180630_181752_add_description_to_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('users', 'description', $this->string(255));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('users', 'description');
        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180630_181752_add_description_to_user_table cannot be reverted.\n";

        return false;
    }
    */
}
