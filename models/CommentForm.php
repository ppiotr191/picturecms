<?php
/**
 * Created by PhpStorm.
 * User: force
 * Date: 25.06.18
 * Time: 17:51
 */

namespace app\models;


use Yii;
use yii\base\Model;

class CommentForm extends Model
{
    public $content;
    public $picture_id;
    public $parent_id;

    public function rules()
    {
        return [
            [['content','picture_id', 'parent_id'], 'required'],
            [['content'], 'string', 'min'=> 5, 'max' => 255],
            [['picture_id', 'parent_id'], 'integer'],
        ];
    }

    public function save(){
        $comment = new Comments();
        $comment->content = $this->content;
        $comment->author_id = Yii::$app->user->id;
        $comment->picture_id = $this->picture_id;
        $comment->parent_id = $this->parent_id;
        $comment->save();
    }
}