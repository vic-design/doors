<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $stock app\fond\entities\manage\Stock */
/* @var $model \app\fond\forms\manage\StockForm */

$this->title = 'Редактирование акции: ' . $stock->name;
$this->params['breadcrumbs'][] = ['label' => 'Акции и новости', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $stock->name, 'url' => ['view', 'id' => $stock->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="stock-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
