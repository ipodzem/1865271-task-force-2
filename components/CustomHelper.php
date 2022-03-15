<?php

namespace app\components;
use yii\helpers\Html;

class CustomHelper
{
    public static function renderScore(?float $score)
    {
        echo Html::beginTag('div', ['class' => 'stars-rating big']);
        for ($i = 1; $i <= round($score); $i++) {
            echo Html::tag('span', '', ['class' => 'fill-star']);
        }
        if (round($score) < 5) {
            for ($i = round($score); $i < 5; $i++) {
                echo Html::tag('span', '');
            }
        }
        echo Html::endTag('div');
    }
}
