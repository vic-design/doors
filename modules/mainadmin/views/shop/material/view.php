<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $material app\fond\entities\manage\shop\Material */

$this->title = $material->name;
$this->params['breadcrumbs'][] = ['label' => 'Материалы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="material-view">

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $material->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $material->id], [
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
                'model' => $material,
                'attributes' => [
                    'id',
                    'name',
                ],
            ]) ?>
        </div>
    </div>

</div>
