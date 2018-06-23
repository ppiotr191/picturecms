<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "files".
 *
 * @property int $id
 * @property string $url
 * @property string $create_date
 */
class Files extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'files';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['create_date'], 'safe'],
            [['url'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'url' => 'Url',
            'create_date' => 'Create Date',
        ];
    }

    public function beforeSave($insert){
        parent::beforeSave($insert);
        if ($insert){
            $date = new \DateTime();
            $this->create_date = $date->format("Y-m-d H:i:s");
        }
        return true;
    }
}
