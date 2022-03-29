<?php

 use yii\widgets\ActiveForm;
 use yii\helpers\Html;

/* @var $model app/models/User;*/
/* @var City[] $cities;*/

$this->title = 'TaskForce. Регистрация';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="center-block">
    <div class="registration-form regular-form">
        <?php $form = ActiveForm::begin(['id' => 'signup-form', 'options' => ['class' => 'registration__form'], 'enableAjaxValidation' => true]); ?>
            <h3 class="head-main head-task">Регистрация нового пользователя</h3>
            <?= $form->field($model, 'name')->textInput() ?>
            <div class="half-wrapper">
                <?= $form->field($model, 'email')->textInput() ?>
                <?= $form->field($model, 'city_id')->dropDownList($cities, ['prompt' => '']) ?>
            </div>
            <?= $form->field($model, 'password_field')->passwordInput() ?>
            <?= $form->field($model, 'password_repeat')->passwordInput() ?>
            <?= $form->field($model, 'responsible')->checkbox() ?>
            <?= Html::submitButton('Создать аккаунт', ['class' => 'button button--blue']) ?>
        <?php ActiveForm::end();?>
    </div>
</div>
