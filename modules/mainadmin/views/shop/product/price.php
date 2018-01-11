<?php
/* @var $this \yii\web\View */
/* @var $product \app\fond\entities\manage\shop\Product */
/* @var $model \app\fond\forms\manage\shop\PriceForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Цены для товара '. $product->name;
$this->params['breadcrumbs'][] = ['label' => 'Товары', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $product->name, 'url' => ['view', 'id' => $product->id]];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="product-price">
    <?php $form = ActiveForm::begin() ?>
    <div class="box">
        <div class="box-default">
            <?= $form->field($model, 'doorOldPrice')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'boxOldPrice')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'boxPrice')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end() ?>
</div>
