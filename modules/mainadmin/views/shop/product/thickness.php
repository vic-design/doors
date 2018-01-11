<?php
/* @var $this \yii\web\View */
/* @var $product \app\fond\entities\manage\shop\Product */
/* @var $model \app\fond\forms\manage\shop\ThicknessForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Характеристики толщины '. $product->name;
$this->params['breadcrumbs'][] = ['label' => 'Товары', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $product->name, 'url' => ['view', 'id' => $product->id]];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="thickness-index">
    <?php $form = ActiveForm::begin() ?>
    <div class="box">
        <div class="box-body">
            <?= $form->field($model, 'doorThickness')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'doorFrameThickness')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'doorSteelThickness')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'frameSteelThickness')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end() ?>
</div>
