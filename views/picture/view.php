<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Pictures */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Pictures', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->registerJsFile(
    '@web/js/pictures.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);
$this->registerJsFile(
    '@web/js/comments.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);
?>
<div class="pictures-view">
    <div class="row">
        <div class="col-md-5">
            <a href="<?=Url::toRoute( ['picture/view', 'id' => $model->id]) ?>"><h1><?=Html::encode($model->name) ?></h1>
                <img src="<?=Url::to($model->file->url, true) ?>" class="img-responsive" alt="<?=$model->name ?>" /></a>
            <p><?=Yii::t('picture', 'author') ?> : <a href="<?=Url::to(['profile/profile', 'id' => $model->author_id]) ?>"><?=$model->author->login ?></a></p>
            <p><?=Yii::t('picture', 'add_date') ?>: <?=$model->create_date ?></p>
            <div ><?=Yii::t('picture', 'rate') ?> : <span class="like"><?=$pictureRating->getPictureRate($model->id); ?></span></div>
            <button link="<?=Url::toRoute('rating/rate') ?>" class="btn btn-success like-event" data-picture_id="<?=$model->id ?>"><?=Yii::t('picture', 'strong') ?></button>
            <button link="<?=Url::toRoute('rating/rate') ?>" class="btn btn-danger like-event dislike-event" data-picture_id="<?=$model->id ?>"><?=Yii::t('picture', 'weak') ?></button>

        </div>
    </div>
    <div class="row">
        <div class="col-md-5">
            <h1><?=Yii::t('picture', 'add_comment') ?></h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-5 comment-form-origin">
        </div>
    </div><hr/>
    <div class="settings"
        data-login="<?=(int)(!Yii::$app->user->getIsGuest()) ?>"
    ></div>
    <div class="languages-data"
         data-add-btn="<?=Yii::t('picture', 'add_comment_btn') ?>"
         data-not-found="<?=Yii::t('picture', 'comment_not_found') ?>"
         data-answer="<?=Yii::t('picture', 'answer') ?>"
         data-add-comment-user-must-be-logged="<?=Yii::t('picture', 'add_comment_user_must_be_logged') ?>"
    ></div>
    <div class="comments" data-pictureid="<?=$model->id ?>">

    </div>
</div>