<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model app\fond\entities\manage\Article */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="article-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="box box-default">
        <div class="box-header with-border">Статья</div>
        <div class="box-body">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'body')->widget(CKEditor::className()); ?>
            <?= $form->field($model, 'slug')->textInput(['maxlength' => true])->hint('Это поле не надо заполнять. От Вас требуется только устранить замечания при их возникновении.') ?>
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
