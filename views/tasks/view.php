<?php

/* @var $this yii\web\View */

/* @var $model app\models\Task */

$this->title = $model->name;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="left-column">
    <div class="head-wrapper">
        <h3 class="head-main"><?= $model->name ?></h3>
        <p class="price price--big"><?= $model->budget ?> ₽</p>
    </div>
    <p class="task-description">
        <?= $model->description ?>
    </p>
    <a href="#" class="button button--blue">Откликнуться на задание</a>
    <div class="task-map">
        <img class="map" src="/img/map.png" width="725" height="346" alt="Новый арбат, 23, к. 1">
        <p class="map-address town">Москва</p>
        <p class="map-address">Новый арбат, 23, к. 1</p>
    </div>
    <h4 class="head-regular">Отклики на задание</h4>
    <?php
    foreach ($model->responses as $response) {
        echo $this->render('_response', ['model' => $response]);
    } ?>
</div>
<div class="right-column">
    <div class="right-card black info-card">
        <h4 class="head-card">Информация о задании</h4>
        <dl class="black-list">
            <dt>Категория</dt>
            <dd><?= $model->category->name ?></dd>
            <dt>Дата публикации</dt>
            <dd><?= Yii::$app->formatter->asRelativeTime($model->created); ?></dd>
            <dt>Срок выполнения</dt>
            <dd><?= $model->term ?></dd>
            <dt>Статус</dt>
            <dd>Открыт для новых заказов</dd>
        </dl>
    </div>
    <div class="right-card white file-card">
        <h4 class="head-card">Файлы задания</h4>
        <ul class="enumeration-list">
            <li class="enumeration-item">
                <a href="#" class="link link--block link--clip">my_picture.jpg</a>
                <p class="file-size">356 Кб</p>
            </li>
            <li class="enumeration-item">
                <a href="#" class="link link--block link--clip">information.docx</a>
                <p class="file-size">12 Кб</p>
            </li>
        </ul>
    </div>
</div>

