<?php

/* @var $this yii\web\View */
/* @var $article app\fond\entities\manage\Article */
/* @var $model \app\fond\forms\manage\ArticleForm */

$this->title = 'Редактирование статьи: ' . $article->name;
$this->params['breadcrumbs'][] = ['label' => 'Статьи', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $article->name, 'url' => ['view', 'id' => $article->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="article-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
