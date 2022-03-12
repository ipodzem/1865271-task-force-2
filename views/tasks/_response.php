<?php

use app\components\CustomHelper;
use yii\helpers\Url;

/* @var $model app\models\Response */

?>
<div class="response-card">
    <img class="customer-photo" src="<?= $model->user->profile->thumb ?>" width="146" height="156"
         alt="Фото заказчиков">
    <div class="feedback-wrapper">
        <a href="#" class="link link--block link--big"><?= $model->user->name ?></a>
        <div class="response-wrapper">
            <?php
            echo CustomHelper::drawScore($model->user->score); ?>
            <p class="reviews"><?= $model->user->ratingsCnt ?></p>
        </div>
        <p class="response-message">
            <?= $model->text ?>
        </p>

    </div>
    <div class="feedback-wrapper">
        <p class="info-text"><span class="current-time"><?= Yii::$app->formatter->asRelativeTime(
                    $model->created
                ); ?></span></p>
        <p class="price price--small"><?= $model->amount ?> ₽</p>
    </div>
    <div class="button-popup">
        <a href="#" class="button button--blue button--small">Принять</a>
        <a href="#" class="button button--orange button--small">Отказать</a>
    </div>
</div>
