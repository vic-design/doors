<?php
/* @var $this \yii\web\View */
/* @var $form \yii\bootstrap\ActiveForm */
/* @var $model \app\fond\forms\shop\AddToCartForm */
/* @var $product \app\fond\entities\manage\shop\Product */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\widgets\Breadcrumbs;

$this->title = 'Добавление товара в корзину';
$this->params['breadcrumbs'][] = ['label' => 'Каталог', 'url' => ['/shop/catalog/index']];
$this->params['breadcrumbs'][] = ['label' => 'Корзина', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="cart-add container-fluid">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= Breadcrumbs::widget([
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ]) ?>

    <div class="row">
        <div class="col-sm-6 col-sm-offset-1">
            <h3><?= $product->name ?>
                <small><?= $product->additional_name ?></small>
            </h3>
            <?php $form = ActiveForm::begin() ?>
            <?php if ($modifications = $model->modificationsList()): ?>
                <?= $form->field($model, 'modification')->dropDownList($modifications, ['prompt' => ' -- Выберите -- ']) ?>
            <?php endif; ?>
            <?php if ($model->sizeList()): ?>
                <?= $form->field($model, 'size')->dropDownList($model->sizeList(), ['prompt' => ' -- Выбрать --']) ?>
            <?php endif; ?>
            <?= $form->field($model, 'quantity')->textInput(['type' => 'number', 'min' => 1, 'step' => 1]) ?>
            <div class="form-group">
                <?= Html::submitButton('Добавить в корзину', ['class' => 'btn btn-primary btn-lg btn-block']) ?>
            </div>
            <?php ActiveForm::end() ?>
        </div>
    </div>
</div>