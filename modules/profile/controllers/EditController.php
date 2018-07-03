<?php

namespace app\modules\profile\controllers;

use app\modules\profile\models\ChangePasswordForm;
use app\modules\profile\models\SettingForm;
use Yii;

class EditController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $changePassword = new ChangePasswordForm();

        if (Yii::$app->request->post('ChangePasswordForm')) {
            $changePassword->load(Yii::$app->request->post());
            if ($changePassword->validate()) {
                Yii::$app->session->setFlash('changePasswordFormSubmitted');
                $changePassword->save();
                return $this->refresh();
            }
        }

        $setting = new SettingForm();
        if (Yii::$app->request->post('SettingForm')) {
            $setting->load(Yii::$app->request->post());
            if ($setting->validate()) {
                Yii::$app->session->setFlash('settingFormSubmitted');
                $setting->save();
                return $this->refresh();
            }
        }
        return $this->render('index', [
            'changePassword' => $changePassword,
            'setting' => $setting,
        ]);
    }
}
