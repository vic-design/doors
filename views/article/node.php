<?php
/* @var $this \yii\web\View */
/* @var $article \app\fond\entities\manage\Article */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;

$this->title = $article->title ? : $article->name;
$this->registerMetaTag(['name' => 'description', 'content' => $article->description]);
$this->registerMetaTag(['name' => 'keywords', 'content' => $article->keywords]);

$this->params['breadcrumbs'][] = $this->title;
?>

<div class="article-index">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ]) ?>

    <?= $article->body ?>
</div>
