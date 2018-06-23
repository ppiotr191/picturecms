<?php

namespace app\controllers;

use app\services\PictureRating;
use Yii;
use yii\base\Module;
use yii\helpers\Json;

class RatingController extends \yii\web\Controller
{
    private $pictureRating;

    public function __construct(string $id, Module $module,PictureRating $pictureRating, array $config = [])
    {
        $this->pictureRating = $pictureRating;
        parent::__construct($id, $module, $config);
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionRate(){
        $userID = Yii::$app->user->id;
        $pictureID = (int)Yii::$app->request->get('picture_id');
        $rating = (int)Yii::$app->request->get('rate');
        $rating = ($rating) ? 1 : -1;

        $this->pictureRating->ratePicture($pictureID, $userID, $rating);
        $rating = $this->pictureRating->getPictureRate($pictureID);
        echo Json::encode(["status" => "ok", "rate" => $rating]);

    }

    public function actionGetRate(){
        $pictureID = (int)Yii::$app->request->get('picture_id');
        $rating = $this->pictureRating->getPictureRate($pictureID);
        echo Json::encode(["rating" => $rating]);
    }

}
