<?php

namespace tests\models;

use app\models\User;
use app\tests\fixtures\UserFixture;

class UserTest extends \Codeception\Test\Unit
{

    protected $user = [
        'email' => 'admin@example.com',
        'password' => 'admintest123',
        'accessToken' => 'xOzSdZwn3e1HB5_MthMbyDeNbkbwFjKd'
    ];

    public function _fixtures()
    {
        return [
            'profiles' => [
                'class' => UserFixture::class,
                'dataFile' => codecept_data_dir() . 'users.php'
            ],
        ];
    }

    public function testFindUserById()
    {
        expect_that($user = User::findIdentity(1));
        expect($user->email)->equals($this->user['email']);
        expect_not(User::findIdentity(999));
    }

    public function testFindUserByAccessToken()
    {
        expect_that($user = User::findIdentityByAccessToken($this->user['accessToken']));
        expect($this->user['accessToken'])->equals($this->user['accessToken']);

        expect_not(User::findIdentityByAccessToken('non-existing'));        
    }

}
