<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;
use kartik\datetime\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model app\fond\entities\manage\Stock */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="stock-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="box box-default">
        <div class="box-header with-border">Акция(новость)</div>
        <div class="box-body">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'start_day')->widget(DateTimePicker::className(), [
                'name' => 'dp_1',
                'type' => DateTimePicker::TYPE_INPUT,
                'options' => ['placeholder' => 'Начало акции( дата новости)'],
                'value' => date('d.m.Y', (integer)$model->start_day),
                'removeButton' => FALSE,
                'convertFormat' => TRUE,
                'pluginOptions' => [
                    'format' => 'dd.MM.yyyy',
                    'autoclose' => TRUE,
                    'weekStart' => 1,
                    'todayBtn' => true,
                ]
            ]) ?>
            <?= $form->field($model, 'summary')->widget(CKEditor::className()); ?>
            <?= $form->field($model, 'body')->widget(CKEditor::className()); ?>
            <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="box box-default">
        <div class="box-header with-border">SEO</div>
        <div class="box-body">
            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'keywords')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
