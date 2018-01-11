<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model \app\fond\forms\manage\shop\CategoryForm */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="category-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="box box-default">
        <div class="box-header with-border">Общее</div>
            <div class="box-body">
                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'parentId')->dropDownList($model->parentCategoryList()) ?>
                <?= $form->field($model, 'body')->widget(CKEditor::className()) ?>
                <?= $form->field($model, 'slug')->textInput(['maxlength' => true])->hint('Не заполняйте это поле. От вас требуется только внести исправления при возникновении замечаний.') ?>
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
