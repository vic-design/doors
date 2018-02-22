<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\mainadmin\forms\CallSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Заказы звонков';
$this->params['breadcrumbs'][] = $this->title;
use app\fond\entities\manage\Call;
use app\fond\helpers\CallHelper;
?>
<div class="call-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php //echo Html::a('Create Call', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <div class="box">
        <div class="box-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'id',
                    [
                        'attribute' => 'name',
                        'value' => function(Call $call)
                        {
                            return Html::a($call->name, ['view', 'id' => $call->id]);
                        },
                        'format' => 'html',
                    ],
                    'phone',
                    [
                        'attribute' => 'status',
                        'filter' => CallHelper::statusList(),
                        'value' => function(Call $call)
                        {
                            return CallHelper::statusLabel($call->status);
                        },
                        'format' => 'html',
                    ],

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        </div>
    </div>

</div>
