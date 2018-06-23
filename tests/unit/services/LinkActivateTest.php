<?php
namespace tests\services;

use app\models\RegisterForm;
use app\services\LinkActivate;
use app\tests\fixtures\TmpUserFixture;
use app\tests\fixtures\UserFixture;

class LinkActivateTest extends \Codeception\Test\Unit
{
    public function _fixtures()
    {
        return [
            'users' => [
                'class' => UserFixture::class,
                'dataFile' => codecept_data_dir() . 'users.php'
            ],
            'tmp_users' => [
                'class' => TmpUserFixture::class,
                'dataFile' => codecept_data_dir() . 'tmp_users.php'
            ]
        ];
    }


    public function testActivateLink(){

        $this->model = new RegisterForm([
            'email' => 'user@test.com',
            'password' => 'test123',
            'confirmPassword' => 'test123',
        ]);

        $token = $this->model->register();

        $linkActivate = new LinkActivate();

        expect($linkActivate->activateLink($token));
        expect_not($this->tester->seeRecord('app\models\TmpUser', ['email' => 'user@test.com']));
        expect($this->tester->seeRecord('app\models\User', ['email' => 'user@test.com']));


    }
}