<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PicturesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pictures';
$this->params['breadcrumbs'][] = $this->title;
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
                <div >Mocne : 0 Słabe : 0</div>
                <button class="btn btn-success">MOCNE</button>
                <button class="btn btn-danger">SŁABE</button>

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
