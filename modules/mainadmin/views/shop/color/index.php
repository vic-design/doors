<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\fond\entities\manage\shop\Color;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Цвета';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="color-index">

    <p>
        <?= Html::a('Добавить цвет', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'name',
                'value' => function(Color $color)
                {
                    return Html::a(Html::encode($color->name), ['view', 'id' => $color->id]);
                },
                'format' => 'html',
            ],
            [
                'attribute' => 'image',
                'value' => function(Color $color)
                {
                    return $color->image ? Html::img($color->getThumbFileUrl('image', 'admin')) : null;
                },
                'format' => 'html',
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
