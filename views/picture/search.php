<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\LinkPager;

$this->title = 'Pictures';
$this->params['breadcrumbs'][] = $this->title;
$this->registerJsFile(
    '@web/js/pictures.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);

?>
<div class="pictures-index">

    <h1><?=Yii::t('form', 'search_phrase'); ?><?=Html::encode($phrase); ?></h1>
    <form action="/picture/search" class="form-inline">
        <div class="form-group">
            <input type="text" class="form-control" name="phrase" id="phrase" placeholder="Fraza" value="<?=Html::encode(trim($phrase)); ?>">
        </div>
        <button type="submit" class="btn btn-default">Szukaj</button>
    </form>
    <?php if (count($models) === 0): ?>
        <?=Yii::t('picture', 'pictures_not_found'); ?>
    <?php endif; ?>
    <?php foreach($models as $model): ?>
        <?= $this->render('_picture', [
            'pictureRating' => $pictureRating,
            'model' => $model,
        ]) ?>
    <?php endforeach; ?>

    <?php
    echo LinkPager::widget([
        'pagination' => $pages,
    ]);
    ?>

</div>
