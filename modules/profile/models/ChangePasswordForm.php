<?php

namespace app\modules\profile\models;

use app\models\User;
use app\modules\profile\ProfileModule;
use Yii;
use yii\base\Model;

class ChangePasswordForm extends Model
{
    public $oldPassword;
    public $password;
    public $confirmPassword;

    public function rules()
    {
        return [
            [['oldPassword', 'password', 'confirmPassword'], 'required'],
            ['confirmPassword', 'compare','compareAttribute' => 'password'],
            [['oldPassword'], 'checkOldPassword']
        ];
    }

    public function attributeLabels()
    {
        return [
            'password' => ProfileModule::t('form', 'password'),
            'oldPassword' => ProfileModule::t('form', 'old_password'),
            'confirmPassword' => ProfileModule::t('form', 'confirm_password'),
        ];
    }

    public function checkOldPassword($attribute, $params){
        $user = $this->getUser();
        if (!$user->validatePassword($this->oldPassword)){
            $this->addError($attribute, ProfileModule::t('form', 'incorrect_old_password'));
        }
    }

    public function save(){
        $user = $this->getUser();
        $user->password = Yii::$app->getSecurity()->generatePasswordHash($this->password);
        $user->save();
    }

    private function getUser(){
        return User::find()->where(['id' => Yii::$app->user->id])->one();
    }

}