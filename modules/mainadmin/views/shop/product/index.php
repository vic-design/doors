<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\fond\entities\manage\shop\Product;
use app\fond\helpers\ProductHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\mainadmin\forms\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Товары';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить товар', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'name',
                'value' => function(Product $product)
                {
                    return Html::a(Html::encode($product->name), ['view', 'id' => $product->id]);
                },
                'format' => 'html',
            ],
            [
                'attribute' => 'category_id',
                'filter' => $searchModel->categoryList(),
                'value' => 'category.name',
            ],
            'code',
            [
                'attribute' => 'status',
                'filter' => ProductHelper::statusList(),
                'value' => function(Product $product)
                {
                    return ProductHelper::statusLabel($product->status);
                },
                'format' => 'html',
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
