<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PicturesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pictures';
$this->params['breadcrumbs'][] = $this->title;
$this->registerJsFile(
    '@web/js/pictures.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);

?>
<div class="pictures-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Pictures', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php foreach($models as $model): ?>
        <div class="row">
            <div class="col-md-5">
                <h1><?=$model->name ?></h1>
                <img src="<?=$model->file->url ?>" class="img-responsive" alt="<?=$model->name ?>" />
                <div >Mocne : <span class="like"><?=$pictureRating->getPictureRate($model->id); ?></span></div>
                <button link="<?=Url::toRoute('rating/rate') ?>" class="btn btn-success like-event" data-picture_id="<?=$model->id ?>">MOCNE</button>
                <button link="<?=Url::toRoute('rating/rate') ?>" class="btn btn-danger like-event dislike-event" data-picture_id="<?=$model->id ?>">SŁABE</button>

            </div>
            <div class="col-md-5">
           </div>
        </div>
    <?php endforeach; ?>

    <?php
    echo LinkPager::widget([
        'pagination' => $pages,
    ]);
    ?>

</div>
