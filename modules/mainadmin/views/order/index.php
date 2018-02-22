<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\fond\helpers\OrderHelper;
use app\fond\order\Order;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\mainadmin\forms\OrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Заказы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'id',
                'value' => function(Order $order)
                {
                    return Html::a(Html::encode($order->id), ['view', 'id' => $order->id]);
                },
                'format' => 'html',
            ],
            [
                'attribute' => 'status',
                'filter' => OrderHelper::statusList(),
                'value' => function(Order $order)
                {
                    return OrderHelper::statusLabel($order->status);
                },
                'format' => 'html',
            ],
            'created_at:datetime',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
