<?php

namespace tests\models;

use app\models\RegisterForm;
use app\tests\fixtures\UserFixture;

class RegisterFormTest extends \Codeception\Test\Unit
{
    private $model;

    protected function _before()
    {
        \Yii::$app->user->logout();
    }

    public function _fixtures()
    {
        return [
            'profiles' => [
                'class' => UserFixture::class,
                'dataFile' => codecept_data_dir() . 'users.php'
            ],
        ];
    }

    public function testRegisterUser()
    {
        $this->model = new RegisterForm([
            'email' => 'user@test.com',
            'password' => 'test123',
            'confirmPassword' => 'test123',
        ]);

        expect($this->model->register());
        expect($this->tester->seeRecord('app\models\TmpUser', ['email' => 'user@test.com']));
    }

    public function testRegisterUserNotSamePasswords()
    {
        $this->model = new RegisterForm([
            'email' => 'user@test.com',
            'password' => 'test123',
            'confirmPassword' => 'test321',
        ]);

        expect_not($this->model->register());
        expect_not($this->tester->seeRecord('app\models\TmpUser', ['email' => 'user@test.com']));
    }

    public function testRegisterUserAlreadyExists()
    {
        $this->model = new RegisterForm([
            'email' => 'admin@example.com',
            'password' => 'test123',
            'confirmPassword' => 'test123',
        ]);

        expect_not($this->model->register());
        expect_not($this->tester->seeRecord('app\models\TmpUser', ['email' => 'user@test.com']));
    }



}