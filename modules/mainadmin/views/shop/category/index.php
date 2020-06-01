<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\fond\entities\manage\shop\Category;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\mainadmin\forms\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Категории';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить категорию', ['create'], ['class' => 'btn btn-success']) ?>
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
                        'value' => function(Category $category)
                        {
                            $indent = ($category->depth > 1 ? str_repeat(' -- ', $category->depth - 1). '  ' : '');
                            return $indent.Html::a(Html::encode($category->name), ['view', 'id' => $category->id]);
                        },
                        'format' => 'html',
                    ],
                    [
                        'value' => function(Category $category)
                        {
                            return Html::a('<span class="glyphicon glyphicon-arrow-up"></span>', ['move-up', 'id' => $category->id]).
                                Html::a('<span class="glyphicon glyphicon-arrow-down"></span>', ['move-down', 'id' => $category->id]);
                        },
                        'format' => 'html'
                    ],
                    'slug',

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        </div>
    </div>

</div>
