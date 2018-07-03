<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class PicturesForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $imageFile;

    public $name;


    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 255, 'min' => 4],
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => Yii::t('form', 'picture_name'),
            'imageFile' => Yii::t('form', 'picture_image_file'),
        ];
    }

    public function save()
    {
        if ($this->validate()) {
            $picture = new Pictures();
            $picture->status = Pictures::STATUS_AWAITING;
            $picture->name = $this->name;
            $picture->author_id = Yii::$app->user->getId();
            $path = 'uploads/' . $this->imageFile->baseName . '.' . $this->imageFile->extension;
            if ($this->imageFile->saveAs('uploads/' . $this->imageFile->baseName . '.' . $this->imageFile->extension)){
                $file = new Files();
                $file->url = $path;
                $save = $file->save(false);

                $errors = $file->errors;
                $fileID = $file->id;
                $picture->file_id = $fileID;
            }
            $picture->save(false);
            return $picture->id;
        } else {
            return false;
        }
    }
}