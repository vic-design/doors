<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model app\fond\entities\manage\shop\Color */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="color-form">

    <?php $form = ActiveForm::begin([
        'options' => ['enctype'=>'multipart/form-data'],
    ]); ?>

    <div class="box">
        <div class="box-header with-border">Название</div>
        <div class="box-body">
            <?= $form->field($model, 'name')->label(false)->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="box">
        <div class="box-header with-border">Изображение</div>
        <div class="box-body">
            <?= $form->field($model, 'image')->widget(FileInput::className(), [
                'options' => [
                    'accept' => 'image/*',
                ],
            ]) ?>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
