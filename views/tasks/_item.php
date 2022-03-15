<?php

use yii\helpers\Html;

/* @var $model app\models\Task */
?>
<div class="task-card">
    <div class="header-task">
        <a href="#" class="link link--block link--big"><?= $model->name ?></a>
        <p class="price price--task"><?= $model->budget ?> ₽</p>
    </div>
    <p class="info-text"><span class="current-time"><?= Yii::$app->formatter->asRelativeTime(
                $model->created
            ); ?> </span></p>
    <p class="task-text"><?= $model->description ?>
    </p>
    <div class="footer-task">
        <p class="info-text town-text"><?=$model->address?></p>
        <p class="info-text category-text"><?=$model->category->name?>></p>
        <?= Html::a('Смотреть Задание', ['view', 'id' => $model->id], ['class' => 'button button--black']) ?>
    </div>
</div>
