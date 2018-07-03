<?php

use app\modules\profile\ProfileModule;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form ActiveForm */
?>
<div class="row">
    <div class="col-md-6">
        <div class="edit-index">
            <h1><?=ProfileModule::t('form', 'change_password'); ?></h1>
            <?php if (Yii::$app->session->hasFlash('changePasswordFormSubmitted')): ?>
                <div class="alert alert-success">
                    <?=ProfileModule::t('form', 'change_password_success'); ?>
                </div>
            <?php endif; ?>

            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($changePassword, 'oldPassword')->passwordInput() ?>

            <?= $form->field($changePassword, 'password')->passwordInput() ?>

            <?= $form->field($changePassword, 'confirmPassword')->passwordInput() ?>

            <div class="form-group">
                <?= Html::submitButton(ProfileModule::t('form', 'submit'), ['class' => 'btn btn-primary']) ?>
            </div>
            <?php ActiveForm::end(); ?>

        </div>
    </div>
    <div class="col-md-6">
        <div class="edit-index">
            <h1><?=ProfileModule::t('form', 'settings'); ?></h1>
            <?php if (Yii::$app->session->hasFlash('settingFormSubmitted')): ?>
                <div class="alert alert-success">
                    <?=ProfileModule::t('form', 'settings_success'); ?>
                </div>
            <?php endif; ?>

            <?php $formSetting = ActiveForm::begin(); ?>

            <?= $formSetting->field($setting, 'description')->textarea() ?>

            <div class="form-group">
                <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
            </div>
            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>

