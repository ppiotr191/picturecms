<?php

use yii\helpers\Html;
use yii\helpers\Url;
?>

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
    <div class="col-md-5">
    </div>
</div>