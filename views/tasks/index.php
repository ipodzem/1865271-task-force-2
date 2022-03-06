<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Новые задания';
$this->params['breadcrumbs'][] = $this->title;
?>
<main class="main-content container">
    <div class="left-column">
        <h3 class="head-main head-task"><?= Html::encode($this->title) ?></h3>

        <?= ListView::widget([
            'dataProvider' => $dataProvider,
            'layout' => '{items}',
            'itemOptions' => ['class' => 'item'],
            'itemView' => '_task'
        ]) ?>
    </div>
    <div class="right-column">
        <div class="right-card black">
            <div class="search-form">
                <form>
                    <h4 class="head-card">Категории</h4>
                    <div class="form-group">
                        <div>
                            <input type="checkbox" id="сourier-services" checked>
                            <label class="control-label" for="сourier-services">Курьерские услуги</label>
                            <input id="cargo-transportation" type="checkbox">
                            <label class="control-label" for="cargo-transportation">Грузоперевозки</label>
                            <input id="translations" type="checkbox">
                            <label class="control-label" for="translations">Переводы</label>
                        </div>
                    </div>
                    <h4 class="head-card">Дополнительно</h4>
                    <div class="form-group">
                        <input id="without-performer" type="checkbox" checked>
                        <label class="control-label" for="without-performer">Без исполнителя</label>
                    </div>
                    <h4 class="head-card">Период</h4>
                    <div class="form-group">
                        <label for="period-value"></label>
                        <select id="period-value">
                            <option>1 час</option>
                            <option>12 часов</option>
                            <option>24 часа</option>
                        </select>
                    </div>
                    <input type="button" class="button button--blue" value="Искать">
                </form>
            </div>
        </div>
    </div>
</main>
