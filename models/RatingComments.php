<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rating_comments".
 *
 * @property int $id
 * @property int $author_id
 * @property int $comment_id
 * @property int $rate
 */
class RatingComments extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rating_comments';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['author_id', 'comment_id', 'rate'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'author_id' => 'Author ID',
            'comment_id' => 'Comment ID',
            'rate' => 'Rate',
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $date = new \DateTime();
                $this->create_date = $date->format("Y-m-d H:i:s");
            }
            return true;
        }
        return false;
    }
}
