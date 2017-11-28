<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $call app\fond\entities\manage\Call */

$this->title = $call->name;
$this->params['breadcrumbs'][] = ['label' => 'Заказы звонка', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="call-view">

    <p>
        <?php if ($call->isDraft()): ?>
        <?= Html::a('Отметить как прочитанное', ['activate', 'id' => $call->id], ['class' => 'btn btn-default', 'data-method' => 'post']) ?>
        <?php else: ?>
        <?= Html::tag('button', 'Прочитано', ['class' => 'btn btn-default']) ?>
        <?php endif; ?>
        <?= Html::a('Update', ['update', 'id' => $call->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $call->id], [
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
                'model' => $call,
                'attributes' => [
                    'id',
                    'name',
                    'phone',
                    'created_at:datetime',
                ],
            ]) ?>
        </div>
    </div>
</div>
