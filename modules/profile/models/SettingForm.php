<?php

namespace app\modules\profile\models;

use app\models\User;
use app\modules\profile\ProfileModule;
use Yii;
use yii\base\Model;

class SettingForm extends Model
{
    public $description;

    public function rules()
    {
        return [
            [['description'], 'safe'],
            [['description'], 'string', 'max' => 255],
        ];
    }
    public function attributeLabels()
    {
        return [
            'description' => ProfileModule::t('form', 'signature'),
        ];
    }

    public function init(){
        $user = $this->getUser();
        $this->description = $user->description;
    }
    public function save(){
        $user = $this->getUser();
        $user->description = $this->description;
        $user->save();
    }

    private function getUser(){
        return User::find()->where(['id' => Yii::$app->user->id])->one();
    }
}