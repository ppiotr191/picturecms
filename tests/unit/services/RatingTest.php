<?php
/**
 * Created by PhpStorm.
 * User: force
 * Date: 23.06.18
 * Time: 16:49
 */

namespace tests\services;


use app\models\Rating;
use app\services\PictureRating;
use app\tests\fixtures\FileFixture;
use app\tests\fixtures\PictureFixture;
use app\tests\fixtures\UserFixture;

class RatingTest extends \Codeception\Test\Unit
{
    public function _fixtures()
    {
        return [
            'users' => [
                'class' => UserFixture::class,
                'dataFile' => codecept_data_dir() . 'users.php'
            ],
            'pictures' => [
                'class' => PictureFixture::class,
                'dataFile' => codecept_data_dir() . 'pictures.php'
            ],
            'files' => [
                'class' => FileFixture::class,
                'dataFile' => codecept_data_dir() . 'files.php'
            ]
        ];
    }

    public function testRating(){

        Rating::deleteAll();
        $rating = new PictureRating();
        $userID = 1;
        $pictureID = 1;

        $rating->ratePicture($pictureID, $userID, 1);
        $rating->ratePicture($pictureID, $userID, 1);
        $rating->ratePicture($pictureID, $userID, 1);
        $rating->ratePicture($pictureID, $userID, 1);
        $rating->ratePicture($pictureID, $userID, -1);

        $rate = $rating->getPictureRate($pictureID);

        self::assertEquals($rate, 3);

    }
}