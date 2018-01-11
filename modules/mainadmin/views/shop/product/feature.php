<?php
/* @var $this \yii\web\View */
/* @var $product \app\fond\entities\manage\shop\Product */
/* @var $model \app\fond\forms\manage\shop\FeaturesForm */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$this->title = 'Характеристики товара '. $product->name;
$this->params['breadcrumbs'][] = ['label' => 'Товары', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $product->name, 'url' => ['view', 'id' => $product->id]];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="feature-index">
    <?php $form = ActiveForm::begin() ?>
    <div class="box">
        <div class="box-body">
            <?= $form->field($model, 'features')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'innerFacing')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'outFacing')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'glass')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end() ?>
</div>
