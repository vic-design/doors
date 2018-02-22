<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\fond\entities\manage\Article;
use app\fond\helpers\ArticleHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\mainadmin\forms\ArticleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Статьи';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавление статьи', ['create'], ['class' => 'btn btn-success']) ?>
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
                        'value' => function(Article $article)
                        {
                            return Html::a($article->name, ['view', 'id' => $article->id]);
                        },
                        'format' => 'html',
                    ],
                    [
                        'attribute' => 'status',
                        'filter' => ArticleHelper::statusList(),
                        'value' => function(Article $article)
                        {
                            return ArticleHelper::statusLabel($article->status);
                        },
                        'format' => 'html',
                    ],

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        </div>
    </div>

</div>
