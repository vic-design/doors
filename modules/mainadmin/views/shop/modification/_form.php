<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\file\FileInput;

/* @var $this \yii\web\View */
/* @var $model \app\fond\forms\manage\shop\ModificationForm */
?>

<div class="modification-form">
    <?php $form = ActiveForm::begin([
        'options' => ['enctype'=>'multipart/form-data'],
    ]) ?>
    <div class="box">
        <div class="box-body">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'additionalName')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'price')->textInput() ?>
            <?= $form->field($model, 'photo')->widget(FileInput::className(), [
                'options' => [
                    'accept' => 'image/*',
                ]
            ]) ?>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end() ?>
</div>
