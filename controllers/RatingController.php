<?php

namespace app\controllers;

use app\services\CommentRating;
use app\services\PictureRating;
use Yii;
use yii\base\Module;
use yii\helpers\Json;

class RatingController extends \yii\web\Controller
{
    private $pictureRating;
    private $commentRating;

    public function __construct(
        string $id,
        Module $module,
        PictureRating $pictureRating,
        CommentRating $commentRating,
        array $config = [])
    {
        $this->commentRating = $commentRating;
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

    public function actionCommentRate(){
        $userID = Yii::$app->user->id;
        $commentID = (int)Yii::$app->request->get('comment_id');
        $rating = (int)Yii::$app->request->get('rate');
        $rating = ($rating) ? 1 : -1;

        $this->commentRating->rateComment($commentID, $userID, $rating);
        $rating = $this->commentRating->getCommentRate($commentID);
        echo Json::encode(["status" => "ok", "rate" => $rating]);

    }

    public function actionGetRate(){
        $pictureID = (int)Yii::$app->request->get('comment_id');
        $rating = $this->pictureRating->getCommentRate($pictureID);
        echo Json::encode(["rating" => $rating]);
    }

}
