<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pictures".
 *
 * @property int $id
 * @property string $name
 * @property int $author_id
 * @property int $file_id
 */
class Pictures extends \yii\db\ActiveRecord
{
    const STATUS_MAIN = 1;
    const STATUS_AWAITING = 0;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pictures';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['author_id', 'file_id'], 'required'],
            [['author_id', 'file_id', 'status'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'author_id' => 'Author ID',
            'file_id' => 'File ID',
        ];
    }
    public function getAuthor()
    {
        return $this->hasOne(User::className(), ['id' => 'author_id']);
    }

    public function getFile()
    {
        return $this->hasOne(Files::className(), ['id' => 'file_id']);
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
