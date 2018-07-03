<?php

namespace app\services;

use app\models\RatingComments;
use yii\base\BaseObject;
use yii\db\Expression;

class CommentRating extends BaseObject
{
    public function rateComment($pictureID, $authorID, $rateValue){
        $rate = new RatingComments();
        $rate->author_id = $authorID;
        $rate->comment_id = $pictureID;
        $rate->rate = $rateValue;
        return $rate->save();
    }

    public function getCommentRate($commentID){
        $rate = RatingComments::find()
            ->select([new Expression('SUM(rate) as total_rate'), 'comment_id'])
            ->where('comment_id = :comment_id', ['comment_id' => $commentID])
            ->groupBy('comment_id')->asArray()->one();

        return (int)$rate['total_rate'];
    }
}