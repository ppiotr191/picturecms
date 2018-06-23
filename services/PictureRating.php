<?php
/**
 * Created by PhpStorm.
 * User: force
 * Date: 23.06.18
 * Time: 16:41
 */

namespace app\services;


use app\models\Rating;
use yii\base\BaseObject;
use yii\db\Expression;

class PictureRating extends BaseObject
{
    public function ratePicture($pictureID, $authorID, $rateValue){
        $rate = new Rating();
        $rate->author_id = $authorID;
        $rate->picture_id = $pictureID;
        $rate->rate = $rateValue;
        return $rate->save();
    }

    public function getPictureRate($pictureID){
        $rate = Rating::find()
            ->select([new Expression('SUM(rate) as total_rate'), 'picture_id'])
            ->where('picture_id = :picture_id', ['picture_id' => $pictureID])
            ->groupBy('picture_id')->asArray()->one();

        return (int)$rate['total_rate'];
    }
}