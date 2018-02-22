<?php
/* @var $this \yii\web\View */
/* @var $product \app\fond\entities\manage\shop\Product */
/* @var $modification \app\fond\entities\manage\shop\Modification */
/* @var $model \app\fond\forms\manage\shop\ModificationForm */

$this->title = 'Редактирование модификации' . $modification->name;
$this->params['breadcrumbs'][] = ['label' => 'Товары', 'url' => ['shop/product/index']];
$this->params['breadcrumbs'][] = ['label' => $product->name, 'url' => ['shop/product/view', 'id' => $product->id]];
$this->params['breadcrumbs'][] = $modification->name;
?>

<div class="modification-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
