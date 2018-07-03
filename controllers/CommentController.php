<?php

namespace app\controllers;

use app\models\CommentForm;
use app\models\Comments;
use Yii;
use yii\helpers\ArrayHelper;

class CommentController extends \yii\web\Controller
{
    private function getComments($pictureID, $parentID){
        $comments = Comments::find()
            ->select(["*", "(SELECT SUM(rate) as total_rate FROM rating_comments WHERE rating_comments.comment_id = comments.id) as points"])
            ->where(['picture_id' => (int)$pictureID, 'parent_id' => $parentID])
            ->orderBy('id DESC')->all();

        $response =  ArrayHelper::toArray($comments, [
            Comments::class => [
                'id',
                'points',
                'content',
                'picture_id',
                'author' => function ($data) {
                    return $data->author->email;
                },
                'children' => function ($data) {
                    return $this->getComments($data->picture_id, $data->id);
                },
            ],
        ]);

        return $response;
    }

    public function actionIndex($pictureID)
    {
        $response =  $this->getComments($pictureID, 0);
        return $this->asJson($response);
    }

    public function actionCreate(){
        $model = new CommentForm();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->asJson($model->save());
        }
        return $this->asJson($model->getErrors());
    }

}
