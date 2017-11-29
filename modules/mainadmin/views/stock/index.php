<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\fond\entities\manage\Stock;
use app\fond\helpers\StockHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\mainadmin\forms\StockSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Акции(новости)';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stock-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить акцию(новость)', ['create'], ['class' => 'btn btn-success']) ?>
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
                        'value' => function(Stock $stock)
                        {
                            return Html::a($stock->name, ['view', 'id' => $stock->id]);
                        },
                        'format' => 'html',
                    ],
                    'start_day',
                    [
                        'attribute' => 'status',
                        'filter' => StockHelper::statusList(),
                        'value' => function(Stock $stock)
                        {
                            return StockHelper::statusLabel($stock->status);
                        }
                    ],

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        </div>
    </div>

</div>
