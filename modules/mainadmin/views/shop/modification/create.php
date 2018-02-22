<?php
/* @var $this \yii\web\View */
/* @var $model \app\fond\forms\manage\shop\ModificationForm */
/* @var $product \app\fond\entities\manage\shop\Product */

$this->title = 'Добавление модификации';
$this->params['breadcrumbs'][] = ['label' => 'Товары', 'url' => ['shop/product/index']];
$this->params['breadcrumbs'][] = ['label' => $product->name, 'url' => ['shop/product/view', 'id' => $product->id]];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="modification-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
