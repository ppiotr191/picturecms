<?php

namespace app\modules\admin;

use Yii;
use yii\web\HttpException;

/**
 * admin module definition class
 */
class AdminModule extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\admin\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
        $this->layout = 'admin';
        if (!Yii::$app->user->can('AdminPanelAccess')) {
            throw new HttpException(401,'Unauthorized');
        }
    }
}
