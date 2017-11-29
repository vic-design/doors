<?php
/* @var $slider \app\fond\entities\manage\Slider */

use yii\helpers\Html;
use yii\bootstrap\Carousel;
?>

<div class="slider">
    <?php $carousel = [] ?>
    <?php foreach ($slider->slides as $slide): ?>
        <?php
        $carousel[] = [
            'content' => Html::img($slide->getThumbFileUrl('file', 'front'), ['alt' => $slider->name, 'class' => 'img-responsive'])
        ];
        ?>
    <?php endforeach; ?>
    <?=
    Carousel::widget([
        'items' => $carousel,
        'options' => ['class' => 'carousel fade'],
            'controls' => [
                '<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>',
                '<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>'
        ],
    ])
    ?>
</div>
