<?php

use app\components\CustomHelper;
use yii\helpers\Url;

/* @var $model app\models\Rating */

?>
<div class="response-card">
    <img class="customer-photo" src="<?= $model->response->user->profile->thumb ?>" width="120" height="127"
         alt="Фото заказчиков">
    <div class="feedback-wrapper">
        <p class="feedback"><?= $model->comment ?></p>
        <?php
        if ($model->rating > 0): ?>
            <p class="task">Задание «<a href="<?= Url::to(['tasks/view/', 'id' => $model->id]) ?>"
                                        class="link link--small"><?= $model->response->task->name ?></a>» выполнено</p>
        <?php
        else: ?>
            <p class="task">Задание «<a href="<?= Url::to(['tasks/view/', 'id' => $model->id]) ?>"
                                        class="link link--small"><?= $model->response->task->name ?></a>» провалено</p>
        <?php
        endif; ?>
    </div>
    <div class="feedback-wrapper">
        <?php
        echo CustomHelper::drawScore($model->rating); ?>
        <p class="info-text"><span class="current-time"><?= Yii::$app->formatter->asRelativeTime(
                    $model->created
                ); ?></span></p>
    </div>
</div>
