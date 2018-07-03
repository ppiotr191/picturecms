<?php
use yii\helpers\Url;

return [
    'register_topic' => 'Link aktywacyjny',
    'register_body' => 'Dziękujemy za rejestracje <br/><br/> <a href="'.Url::base(true).'/register/activate?token={token}">Kliknij tutaj by aktywować konto</a>'
];