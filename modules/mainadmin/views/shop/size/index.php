<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\fond\entities\manage\shop\Size;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Размеры';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="size-index">

    <p>
        <?= Html::a('Добавить размер', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'name',
                'value' => function(Size $size)
                {
                    return Html::a(Html::encode($size->name), ['view', 'id' => $size->id]);
                },
                'format' => 'html',
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
