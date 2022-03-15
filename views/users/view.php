<?php

use app\components\CustomHelper;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $provider yii\data\ActiveDataProvider */

$this->title = $model->name;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="left-column">
    <h3 class="head-main"><?= $model->name ?></h3>
    <div class="user-card">
        <div class="photo-rate">
            <img class="card-photo" src="<?= $model->profile->thumb ?>" width="191" height="190"
                 alt="Фото пользователя">
            <div class="card-rate">
                <?php
                CustomHelper::renderScore($model->score); ?>
                <span class="current-rate"><?= $model->score ?></span>
            </div>
        </div>
        <p class="user-description">
            <?= $model->profile->about ?>
        </p>
    </div>
    <div class="specialization-bio">
        <div class="specialization">
            <?php
            if (count($model->categories) > 0) { ?>
                <p class="head-info">Специализации</p>
                <ul class="special-list">
                    <?php
                    foreach ($model->categories as $category) { ?>
                        <li class="special-item">
                            <a href="#" class="link link--regular"><?= $category->name ?></a>
                        </li>
                    <?php
                    } ?>
                </ul>
            <?php
            } ?>
        </div>
        <div class="bio">
            <p class="head-info">Био</p>
            <p class="bio-info"><span class="country-info">Россия</span>, <span
                    class="town-info"><?= $model->profile->address ?>></span>, <span
                    class="age-info"><?= $model->profile->age ?></span> лет</p>
        </div>
    </div>
    <h4 class="head-regular">Отзывы заказчиков</h4>
    <?= ListView::widget([
        'dataProvider' => $provider,
        'layout' => '{items}',
        'itemOptions' => ['class' => 'item'],
        'itemView' => '_feedback',
        'emptyText' => 'Нет отзывов'
    ]) ?>


</div>
<div class="right-column">
    <div class="right-card black">
        <h4 class="head-card">Статистика исполнителя</h4>
        <dl class="black-list">
            <dt>Всего заказов</dt>
            <dd><?= $model->countSuccessfullTasks ?> выполнено, <?= $model->countFailTasks ?> провалено</dd>
            <dt>Место в рейтинге</dt>
            <dd><?= $model->place; ?> место</dd>
            <dt>Дата регистрации</dt>
            <dd><?= Yii::$app->formatter->asDateTime($model->created, "php: d F Y, h:i"); ?></dd>
            <dt>Статус</dt>
            <dd>Открыт для новых заказов</dd>
        </dl>
    </div>
    <div class="right-card white">
        <h4 class="head-card">Контакты</h4>
        <ul class="enumeration-list">
            <li class="enumeration-item">
                <a href="#" class="link link--block link--phone"><?= Yii::$app->formatter->asPhone(
                        $model->profile->phone
                    ) ?></a>
            </li>
            <li class="enumeration-item">
                <a href="mailto:<?= $model->email ?>" class="link link--block link--email"><?= $model->email ?></a>
            </li>
            <li class="enumeration-item">
                <a href="#" class="link link--block link--tg">@<?= $model->profile->skype ?></a>
            </li>
        </ul>
    </div>
</div>

