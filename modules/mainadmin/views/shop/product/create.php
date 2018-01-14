<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use kartik\file\FileInput;


/* @var $this yii\web\View */
/* @var $model \app\fond\forms\manage\shop\ProductCreateForm */

$this->title = 'Добавление товара';
$this->params['breadcrumbs'][] = ['label' => 'Товары', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-create">

    <?php $form = ActiveForm::begin([
        'enableClientValidation' => false,
        'options' => ['enctype' => 'multipart/form-data'],
    ]) ?>
    <div class="box box-default">
        <div class="box-header with-border">Общее</div>
        <div class="box-body">
            <div class="row">
                <div class="col-sm-4">
                    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-sm-4">
                    <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-sm-4">
                    <?= $form->field($model, 'slug')->textInput(['maxlength' => true])->hint('не заполняйте это поле. При возникновении ошибок и замечаний, обратитесь к администратору и получите инструкции по заполнению.') ?>
                </div>
            </div>
            <br>
            <div>
                <?= $form->field($model, 'body')->widget(CKEditor::className()) ?>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <div class="box box-default">
                <div class="box-header with-border">Категория</div>
                <div class="box-body">
                    <?= $form->field($model->categories, 'main')->dropDownList($list = $model->categories->categoriesList(), ['prompt' => '']) ?>
                    <?= $form->field($model->categories, 'others')->checkboxList($list) ?>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="box box-default">
                <div class="box-header with-border">Цены</div>
                <div class="box-body">
                    <?= $form->field($model->price, 'doorOldPrice')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model->price, 'boxOldPrice')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model->price, 'boxPrice')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model->price, 'oldPrice')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model->price, 'price')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
            <div class="box box-default">
                <div class="box-header with-border">Толщина</div>
                <div class="box-body">
                    <?= $form->field($model->thickness, 'doorThickness')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model->thickness, 'doorFrameThickness')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model->thickness, 'doorSteelThickness')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model->thickness, 'frameSteelThickness')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
            <div class="box box-default">
                <div class="box-header with-border">Характеристики</div>
                <div class="box-body">
                    <?= $form->field($model->features, 'innerFacing')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model->features, 'outFacing')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model->features, 'glass')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model->features, 'features')->widget(CKEditor::className()) ?>
                </div>
            </div>
            <div class="box">
                <div class="box-header with-border">Цвета</div>
                <div class="box-body">
                    <?= $form->field($model->colors, 'existing')->checkboxList($model->colors->colorList()) ?>
                </div>
            </div>
            <div class="box">
                <div class="box-header with-border">Материалы</div>
                <div class="box-body">
                    <?= $form->field($model->materials, 'existing')->checkboxList($model->materials->materialList()) ?>
                </div>
            </div>
            <div class="box">
                <div class="box-header with-border">Размеры</div>
                <div class="box-body">
                    <?= $form->field($model->sizes, 'existing')->checkboxList($model->sizes->sizeList()) ?>
                </div>
            </div>
        </div>
    </div>

    <div class="box box-default">
        <div class="box-header with-border">Фотографии</div>
        <div class="box-body">
            <?= $form->field($model->photos, 'files[]')->widget(FileInput::className(), [
                'options' => [
                    'accept' => 'image/*',
                    'multiple' => true,
                ],
            ]) ?>
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
    <?php ActiveForm::end() ?>

</div>
