<?php
namespace app\services;

use app\models\TmpUser;
use app\models\User;
use Yii;
use yii\base\BaseObject;

class LinkActivate extends BaseObject
{
    public function activateLink($token){
        $token = Yii::$app->jwt->getParser()->parse((string) $token);


        $userid = $token->getHeader('jti');
        $email = $token->getClaim('email');

        $tmpUser = TmpUser::find()->where(['id' => $userid, 'email' => $email])->one();

        if ($tmpUser === null){
            return false;
        }


        $transaction = User::getDb()->beginTransaction();
        try {
            $user = new User();
            $user->email = $email;
            $user->login = $tmpUser->login;
            $user->password = $tmpUser->password;
            $user->create_date = $tmpUser->create_date;
            $user->save();
            $tmpUser->delete();
            $transaction->commit();
        } catch(\Exception $e) {
            $transaction->rollBack();
            throw $e;
        } catch(\Throwable $e) {
            $transaction->rollBack();
            throw $e;
        }
        return $user;
    }
}