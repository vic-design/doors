<?php
/* @var $this \yii\web\View */
/* @var $stock \app\fond\entities\manage\Stock */

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

$this->title = $stock->title ?: $stock->name;
if (!empty($stock->description)) $this->registerMetaTag(['name' => 'description', 'content' => $stock->description]);
if (!empty($stock->keywords)) $this->registerMetaTag(['name' => 'keywords', 'content' => $stock->keywords]);

$this->params['breadcrumbs'][] = ['label' => 'Новости и акции', 'url' => ['/stock/page']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="stock-node">
    <h1><?= Html::encode($stock->name) ?></h1>

    <?= Breadcrumbs::widget([
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ]) ?>

    <p>
        <?= $stock->start_day ?>
    </p>

    <?= $stock->body ?>
</div>
