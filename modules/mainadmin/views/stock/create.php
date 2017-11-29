<?php

/* @var $this yii\web\View */
/* @var $model \app\fond\forms\manage\StockForm */

$this->title = 'Добавление акции';
$this->params['breadcrumbs'][] = ['label' => 'Акции и новости', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stock-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
