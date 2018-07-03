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
