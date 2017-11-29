<?php
/* @var $this \yii\web\View */
/* @var $stocks \app\fond\entities\manage\Stock */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;

$this->title = 'Новости и акции';
$this->registerMetaTag(['name' => 'description', 'content' => '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => '']);

$this->params['breadcrumbs'][] = $this->title;
?>

<div class="stock-page">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ]) ?>

    <?php foreach ($stocks as $stock): ?>
    <div class="stock-block">
        <a href="<?= Url::to(['/stock/node', 'slug' => $stock->slug]) ?>">
            <h2><?= Html::encode($stock->name) ?></h2>
        </a>

        <p>
            <?= $stock->start_day ?>
        </p>

        <?= $stock->summary ?>

        <p>
            <a href="<?= Url::to(['/stock/node', 'slug' => $stock->slug]) ?>">Подробнее >>></a>
        </p>

    </div>
    <?php endforeach; ?>
</div>
