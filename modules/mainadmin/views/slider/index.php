<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\fond\entities\manage\Slider;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Слайдеры';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="slider-index">

    <p>
        <?= Html::a('Добавление слайдера', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="box">
        <div class="box-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'id',
                    [
                        'attribute' => 'name',
                        'value' => function(Slider $slider)
                        {
                            return Html::a($slider->name, ['view', 'id' => $slider->id]);
                        },
                        'format' => 'html',
                    ],

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        </div>
    </div>

</div>
