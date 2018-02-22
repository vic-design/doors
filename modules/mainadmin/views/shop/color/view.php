<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $color app\fond\entities\manage\shop\Color */

$this->title = $color->name;
$this->params['breadcrumbs'][] = ['label' => 'Цвета', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="color-view">

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $color->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $color->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <div class="box">
        <div class="box-body">
            <?= DetailView::widget([
                'model' => $color,
                'attributes' => [
                    'id',
                    'name',
                    [
                        'attribute' => 'image',
                        'value' => $color->image ? Html::img($color->getThumbFileUrl('image', 'admin')) : null,
                        'format' => 'html',
                    ],
                ],
            ]) ?>
        </div>
    </div>
</div>
