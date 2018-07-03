<?php

use app\modules\profile\ProfileModule;
use yii\helpers\Html;
?>
<div class="row">
    <div class="col-md-4">
        <h2><?=Html::encode($user->login) ?></h2>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <h3><?=ProfileModule::t('main', 'pictures_main') ?>:</h3>
    </div>
    <div class="col-md-4">
        <h3><?=$picturesMain ?></h3>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <h3><?=ProfileModule::t('main', 'pictures_awaiting') ?>:</h3>
    </div>
    <div class="col-md-4">
        <h3><?=$picturesAwaiting ?></h3>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <h3><?=ProfileModule::t('main', 'pictures_comments') ?>:</h3>
    </div>
    <div class="col-md-4">
        <h3><?=$comments?></h3>
    </div>
</div>
<div class="row">
    <div class="col-md-8">
        <hr />
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <h3><?=ProfileModule::t('main', 'rating_for_pictures') ?>:</h3>
    </div>
    <div class="col-md-4">
        <h3><?=$rate ?></h3>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <h3><?=ProfileModule::t('main', 'rating_for_comments') ?>:</h3>
    </div>
    <div class="col-md-4">
        <h3><?=$rateComments ?></h3>
    </div>
</div>
<div class="row">
    <div class="col-md-8">
        <hr />
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <h3><?=ProfileModule::t('main', 'signature') ?>:</h3>
    </div>
    <div class="col-md-4">
        <h3><?=Html::encode($user->description) ?></h3>
    </div>
</div>