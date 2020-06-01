<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $size app\fond\entities\manage\shop\Size */

$this->title = $size->name;
$this->params['breadcrumbs'][] = ['label' => 'Размеры', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="size-view">

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $size->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $size->id], [
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
                'model' => $size,
                'attributes' => [
                    'id',
                    'name',
                ],
            ]) ?>
        </div>
    </div>


</div>
