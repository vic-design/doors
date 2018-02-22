<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\fond\helpers\OrderHelper;

/* @var $this yii\web\View */
/* @var $order app\fond\order\Order */

$this->title = $order->id;
$this->params['breadcrumbs'][] = ['label' => 'Заказы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-view">

    <p>
        <?php if ($order->isNew()): ?>
        <?= Html::a('Изменить на УКОМПЛЕКТОВАН', ['complete', 'id' => $order->id], ['class' => 'btn btn-warning', 'data-method' => 'post']) ?>
        <?= Html::a('Анулировать заказ', ['cancelled', 'id' => $order->id], ['class' => 'btn btn-danger', 'data-method' => 'post']) ?>
        <?php elseif ($order->isCompleted()): ?>
        <?= Html::a('Изменить на ОТПРАВЛЕН', ['sent', 'id' => $order->id], ['class' => 'btn btn-success', 'data-method' => 'post']) ?>
            <?= Html::a('Анулировать заказ', ['cancelled', 'id' => $order->id], ['class' => 'btn btn-danger', 'data-method' => 'post']) ?>
        <?php elseif ($order->isSent()): ?>
        <?= Html::tag('span', 'Заказ отправлен', ['class' => 'btn btn-success']) ?>
            <?= Html::a('Анулировать заказ', ['cancelled', 'id' => $order->id], ['class' => 'btn btn-danger', 'data-method' => 'post']) ?>
        <?php else: ?>
        <?= Html::tag('span', 'Заказ анулирован', ['class' => 'btn btn-danger']) ?>
        <?php endif; ?>
        <?= Html::a('Редактировать', ['update', 'id' => $order->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $order->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="box">
        <div class="box-header with-border">Заказ</div>
        <div class="box-body">
            <?= DetailView::widget([
                'model' => $order,
                'attributes' => [
                    'id',
                    'customer_name',
                    'customer_phone',
                    'customer_email:email',
                    'cost',
                    'note:ntext',
                    [
                        'attribute' => 'status',
                        'value' => OrderHelper::statusLabel($order->status),
                        'format' => 'html',
                    ],
                    'created_at:datetime',
                ],
            ]) ?>
        </div>
    </div>

    <div class="box">
        <div class="box-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Название товара</th>
                            <th>Модель</th>
                            <th>Размер</th>
                            <th>Количество</th>
                            <th>Цена за единицу</th>
                            <th>Всего</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($order->items as $item): ?>
                            <tr>
                                <td>
                                    Арт. <?= Html::encode($item->product_code) ?> <br>
                                    <?= Html::encode($item->product_name) ?>
                                </td>
                                <td>
                                    <?php  if ($item->modification_id): ?>
                                        Арт. <?= Html::encode($item->modification_code) ?>
                                        <?= Html::encode($item->modification_name) ?>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($item->size): ?>
                                        <?= $item->size ?>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?= $item->quantity ?>
                                </td>
                                <td>
                                    <?= $item->price ?>  <i class="fa fa-rub" aria-hidden="true"></i>
                                </td>
                                <td>
                                    <?= $item->getCost() ?>  <i class="fa fa-rub" aria-hidden="true"></i>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <?php if ($order->isCancelled()): ?>
        <div class="box">
            <div class="box-body">
                <?= DetailView::widget([
                    'model' => $order,
                    'attributes' => [
                        'cancelled_reason:ntext',
                    ]
                ]) ?>
            </div>
        </div>
    <?php endif; ?>


</div>
