<?php

use yii\db\Migration;

/**
 * Class m180626_230310_add_column_login_to_users
 */
class m180626_230310_add_column_login_to_users extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('tmp_users', 'login', $this->string()->after('id'));
        $this->addColumn('users', 'login', $this->string()->after('id'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('tmp_users', 'login');
        $this->dropColumn('users', 'login');
    }
}
