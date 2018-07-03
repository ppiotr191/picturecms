<?php

namespace app\modules\admin\controllers;

use app\models\Comments;
use app\models\Pictures;
use app\models\User;

use yii\web\Controller;

/**
 * Default controller for the `admin` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $statistic = [
            'picturesMainAll' => Pictures::find()->where(['status' => Pictures::STATUS_MAIN])->count(),
            'picturesMainMonth' => Pictures::find()->where(['status' => Pictures::STATUS_MAIN])
                ->where(['MONTH(create_date)' => date('m'), 'YEAR(create_date)' => date('Y')])->count(),
            'picturesAwaitingAll' => Pictures::find()->where(['status' => Pictures::STATUS_AWAITING])->count(),
            'picturesAwaitingMonth' => Pictures::find()->where(['status' => Pictures::STATUS_AWAITING])
                ->where(['MONTH(create_date)' => date('m'), 'YEAR(create_date)' => date('Y')])->count(),
            'accountsAll' => User::find()->count(),
            'commentsAll' => Comments::find()->count(),


        ];
        return $this->render('index', $statistic);
    }
}
