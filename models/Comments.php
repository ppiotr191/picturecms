<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "comments".
 *
 * @property int $id
 * @property int $author_id
 * @property string $content
 * @property int $picture_id
 * @property int $parent_id
 */
class Comments extends \yii\db\ActiveRecord
{
    public $points;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'comments';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['author_id', 'picture_id'], 'required'],
            [['author_id', 'picture_id', 'parent_id'], 'integer'],
            [['content'], 'string', 'max' => 255],
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
            'content' => 'Content',
            'picture_id' => 'Picture ID',
            'parent_id' => 'Parent ID',
        ];
    }

    public function getAuthor()
    {
        return $this->hasOne(User::className(), ['id' => 'author_id']);
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
