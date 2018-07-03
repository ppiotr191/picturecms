<?php

namespace app\modules\profile\controllers;

use app\models\Comments;
use app\models\Pictures;
use app\models\Rating;
use app\models\RatingComments;
use app\models\User;
use Yii;
use yii\web\HttpException;

class ProfileController extends \yii\web\Controller
{
    public function actionIndex($id)
    {
        $user = User::find()->where(['id' => $id])->one();
        if (empty($user)){
            throw new HttpException( 404, 'Profile not found');
        }

        $profile = $this->getProfileArray($user);
        return $this->render('profile', $profile);
    }

    public function actionOwn()
    {
        $user = User::find()->where(['id' => Yii::$app->user->id])->one();

        $profile = $this->getProfileArray($user);

        return $this->render('profile', $profile);
    }

    private function getProfileArray($user){
        $profile = [
            'user' => $user,
            'picturesMain' => Pictures::find()->where(['author_id' => $user->id, 'status' => 0])->count(),
            'picturesAwaiting' => Pictures::find()->where(['author_id' => $user->id, 'status' => 1])->count(),
            'comments' => Comments::find()->where(['author_id' => $user->id])->count(),
            'rate' => (int)Yii::$app->db->createCommand("SELECT SUM(".Rating::tableName().".rate) FROM ".Rating::tableName()."
                LEFT JOIN ".Pictures::tableName()."
                    ON (".Rating::tableName().".picture_id = ".Pictures::tableName().".id)
                    WHERE ".Pictures::tableName().".author_id = :author_id ", [':author_id' => $user->id])->queryScalar(),
            'rateComments' => (int)Yii::$app->db->createCommand("SELECT SUM(".RatingComments::tableName().".rate) FROM ".RatingComments::tableName()."
                LEFT JOIN ".Comments::tableName()."
                    ON (".RatingComments::tableName().".comment_id = ".Comments::tableName().".id)
                    WHERE ".Comments::tableName().".author_id = :author_id ", [':author_id' => $user->id])->queryScalar()
        ];

        return $profile;
    }

}
