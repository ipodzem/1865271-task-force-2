<?php

namespace app\components;

class CustomHelper
{
    public function drawScore(?float $score)
    {
        echo '<div class="stars-rating big">';
        for ($i = 1; $i <= round($score); $i++) {
            echo '<span class="fill-star">&nbsp;</span>';
        }
        if (round($score) < 5) {
            for ($i = round($score); $i < 5; $i++) {
                echo '<span>&nbsp;</span>';
            }
        }
        echo '</div>';
    }
}
