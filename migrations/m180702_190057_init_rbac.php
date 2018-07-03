<?php

use yii\db\Migration;

/**
 * Class m180702_190057_init_rbac
 */
class m180702_190057_init_rbac extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $auth = Yii::$app->authManager;
        $createAdmin = $auth->createPermission('AdminPanelAccess');
        $createAdmin->description = 'Access to admin panel';
        $auth->add($createAdmin);

        $admin = $auth->createRole('admin');
        $auth->add($admin);

        $auth->addChild($admin, $createAdmin);
        $auth->assign($admin, 1);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $auth = Yii::$app->authManager;
        $auth->removeAll();
    }
}
