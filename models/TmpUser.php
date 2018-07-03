<?php

namespace app\models;


use Yii;
use yii\db\ActiveRecord;

class TmpUser extends ActiveRecord
{
    public static function tableName()
    {
        return 'tmp_users';
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->password = Yii::$app->getSecurity()->generatePasswordHash($this->password);
                $date = new \DateTime();
                $this->create_date = $date->format("Y-m-d H:i:s");
            }
            return true;
        }
        return false;
    }
}