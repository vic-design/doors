<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $stock app\fond\entities\manage\Stock */

$this->title = $stock->name;
$this->params['breadcrumbs'][] = ['label' => 'Акции и новости', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stock-view">

    <p>
        <?php if ($stock->isDraft()): ?>
        <?= Html::a('Опубликовать', ['activate', 'id' => $stock->id], ['class' => 'btn btn-success', 'data-method' => 'post']) ?>
        <?php else: ?>
        <?= Html::a('Снять с публикации', ['draft', 'id' => $stock->id], ['class' => 'btn btn-danger', 'data-method' => 'post']) ?>
        <?php endif; ?>
        <?= Html::a('Редактировать', ['update', 'id' => $stock->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $stock->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="box box-default">
        <div class="box-header with-border">Акция(новость)</div>
        <div class="box-body">
            <?= DetailView::widget([
                'model' => $stock,
                'attributes' => [
                    'id',
                    'name',
                    'start_day',
                    'summary:html',
                    'body:html',
                    'slug',
                    'created_at:datetime',
                    'updated_at:datetime',
                ],
            ]) ?>
        </div>
    </div>


    <div class="box box-default">
        <div class="box-header with-border">SEO</div>
        <div class="box-body">
            <?= DetailView::widget([
                'model' => $stock,
                'attributes' => [
                    'title',
                    'description',
                    'keywords',
                ],
            ]) ?>
        </div>
    </div>

</div>
