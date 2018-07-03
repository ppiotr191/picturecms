<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => Yii::t('main', 'main_page'), 'url' => ['/picture/index']],
            ['label' => Yii::t('main', 'awaiting'), 'url' => ['/picture/awaiting']],
            ['label' => Yii::t('main', 'random'), 'url' => ['/picture/random']],
            ['label' => Yii::t('main', 'top'), 'url' => ['/picture/top']],
            ['label' => Yii::t('main', 'search'),
                'items' =>[
                    '<li><form action="/picture/search" class="form-inline">
                      <div class="form-group">
                        <input type="text" class="form-control" name="phrase" id="phrase" placeholder="Fraza">
                      </div>
                      <button type="submit" class="btn btn-default">'.Yii::t('main', 'search_btn').'</button>
                    </form></li>']
            ],
            Yii::$app->user->isGuest ? (['label' => Yii::t('main', 'register'), 'url' => ['/register/index']]) : '',
            !Yii::$app->user->isGuest ? (['label' => Yii::t('main', 'add_picture'), 'url' => ['/picture/create']]) : '',
            Yii::$app->user->isGuest ? (
                ['label' => Yii::t('main', 'login'), 'url' => ['/site/login']]
            ) : [
                    'label' => Yii::t('main', 'profil'),
                    'items' => [
                        ['label' => Yii::t('main', 'profil'), 'url' => ['/profile/profile/own']],
                        ['label' => Yii::t('main', 'settings'), 'url' => ['/profile/edit']],
                        ['label' => Yii::t('main', 'my_pictures'), 'url' => ['/picture/user', 'id' => Yii::$app->user->id]],
                        ['label' => Yii::t('main', 'logout'), 'url' => ['/site/logout']],
                    ]
             ]
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
