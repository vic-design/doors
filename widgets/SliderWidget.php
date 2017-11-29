<?php

namespace app\widgets;

use app\fond\entities\manage\Slider;
use yii\base\Widget;

class SliderWidget extends Widget
{
    public function run() {
        $slider = Slider::findOne(2);

        return $this->render('slider', [
            'slider' => $slider,
        ]);
    }
}