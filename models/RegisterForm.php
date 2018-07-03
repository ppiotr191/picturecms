<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\helpers\Url;

class RegisterForm extends Model
{

    public $login;
    public $email;
    public $password;
    public $confirmPassword;

    public function rules()
    {
        return [
            [['login', 'email', 'password', 'confirmPassword'], 'required'],
            ['confirmPassword', 'compare','compareAttribute' => 'password'],
            [['email'], 'uniqueEmail'],
            [['login'], 'uniqueLogin']
        ];
    }

    public function uniqueEmail($attribute, $params){

        $user = User::find()->where([$attribute => $this->email])->one();
        if ($user !== null){
            $this->addError($attribute, Yii::t('form', 'email_exists'));
        }
    }
    public function uniqueLogin($attribute, $params){

        $user = User::find()->where([$attribute => $this->login])->one();
        if ($user !== null){
            $this->addError($attribute, Yii::t('form', 'login_exists'));
        }
    }

    public function attributeLabels()
    {
        return [
            'username' => Yii::t('form', 'username'),
            'confirmPassword' => Yii::t('form', 'confirm_password'),
            'email' => Yii::t('form', 'email'),
        ];
    }

    public function register()
    {
        if ($this->validate()){

            $user = new TmpUser();
            $user->login = $this->login;
            $user->email = $this->email;
            $user->password = $this->password;
            $user->save();

            $token = Yii::$app->jwt->getBuilder()->setIssuer(Url::base())
            ->setAudience(Url::base())
            ->setId($user->id, true)
            ->setIssuedAt(time())
            ->setNotBefore(time() + 60)
            ->setExpiration(time() + 3600)
            ->set('email', $user->email)
            ->getToken();

            Yii::$app->mailer->compose()
                ->setTo($user->email)
                ->setFrom([$this->email => $this->email])
                ->setSubject(Yii::t('mail', 'register_topic'))
                ->setTextBody(Yii::t('mail', 'register_body', ['token' => $token]))
                ->send();

            return $token;
        }

        return false;
    }
}