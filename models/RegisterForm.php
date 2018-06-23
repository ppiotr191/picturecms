<?php

namespace app\models;


use Yii;
use yii\base\Model;
use yii\helpers\Url;

class RegisterForm extends Model
{

    public $email;
    public $password;
    public $confirmPassword;

    public function rules()
    {
        return [
            [['email', 'password', 'confirmPassword'], 'required'],
            ['confirmPassword', 'compare','compareAttribute' => 'password'],
            [['email'], 'uniqueUser']
        ];
    }

    public function uniqueUser($attribute, $params){
        $user = User::find()->where(['email' => $this->email])->one();
        if ($user !== null){
            $this->addError($attribute, 'Email is already exists.');
        }
    }

    public function register()
    {
        if ($this->validate()){

            $user = new TmpUser();
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
                ->setSubject('Activation Link')
                ->setTextBody($token)
                ->send();

            return $token;
        }

        return false;
    }
}