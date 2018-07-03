<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PicturesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pictures';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pictures-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php \yii\widgets\Pjax::begin(); ?>
        <?= GridView::widget([
            'id' => 'picture-grid',
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'id',
                'name',
                [
                    'label' => 'Author',
                    'value' => function ($model) {
                        return $model->author->email;
                    }
                ],
                [
                    'label' => 'Status',
                    'attribute' => 'status',
                    'value' => function ($model) {
                        if ($model->status === 1){
                            return 'Główna';
                        }
                        if ($model->status === 0){
                            return 'Poczekalnia';
                        }
                    }
                ],

                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{view} {update} {delete} {accept}',
                    'buttons' => [
                        'view' => function($url){
                            return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, ["target" => "_blank"]);
                        },
                        'delete' => function ($url) {
                            return Html::a('<span  class="glyphicon glyphicon-trash"></span>', '#', [
                                'title' => Yii::t('yii', 'Delete'),
                                'aria-label' => Yii::t('yii', 'Delete'),
                                'onclick' => "
                                if (confirm('Are you sure?')) {
                                    $.ajax('$url', {
                                        type: 'POST'
                                    }).done(function(data) {
                                        $.pjax.reload({container: '#picture-grid'});
                                    });
                                }
                                return false;
                            ",
                            ]);
                        },
                        'update' => function ($url,$model) {
                            return Html::a(
                                '<span class="glyphicon glyphicon-edit"></span>',
                                $url);
                        },
                        'accept' => function ($url,$model,$key) {
                            return Html::a('<span  class="glyphicon glyphicon-ok"></span>', '#', [
                                'title' => Yii::t('yii', 'Accept'),
                                'aria-label' => Yii::t('yii', 'Accept'),
                                'onclick' => "
                                    $.ajax('$url', {
                                        type: 'POST'
                                    }).done(function(data) {
                                        $.pjax.reload({container: '#picture-grid'});
                                    });
                                    return false;
                            ",
                            ]);
                        },
                    ],
                ],
            ],
        ]); ?>
    <?php \yii\widgets\Pjax::end(); ?>
</div>
