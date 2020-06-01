<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\file\FileInput;


/* @var $this yii\web\View */
/* @var $model \app\fond\forms\manage\SliderCreateForm */

$this->title = 'Добавление слайдера';
$this->params['breadcrumbs'][] = ['label' => 'Слайдеры', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="slider-create">

    <?php $form = ActiveForm::begin([
        'enableClientValidation' => FALSE,
        'options' => ['enctype' => 'multipart/form-data'],
    ]) ?>

    <div class="box box-default">
        <div class="box-header with-border">Слайдер</div>
        <div class="box-body">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="box box-default">
        <div class="box-header with-border">Слайды</div>
        <div class="box-body">
            <?= $form->field($model->slides, 'files[]')->widget(FileInput::className(), [
                'options' => [
                    'accept' => 'image/*',
                    'multiple' => TRUE,
                ],
            ]) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end() ?>

</div>
