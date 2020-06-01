<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $slider app\fond\entities\manage\Slider */
/* @var $slidesForm \app\fond\forms\manage\SlideForm */

$this->title = $slider->name;
$this->params['breadcrumbs'][] = ['label' => 'Слайдеры', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="slider-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $slider->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $slider->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="box box-default">
        <div class="box-header with-border">Слайдер</div>
        <div class="box-body">
            <?= DetailView::widget([
                'model' => $slider,
                'attributes' => [
                    'id',
                    'name',
                ],
            ]) ?>
        </div>
    </div>


    <div class="box box-default">
        <div id="slides" class="box-header with-border">Слайдер</div>
        <div class="box-body">
            <div class="row">
                <?php foreach ($slider->slides as $slide): ?>
                <div class="col-sm-4 text-center">
                    <div class="btn-group">
                        <?= Html::a('<i class="fa fa-arrow-circle-left"></i>', ['move-slide-up', 'id' => $slider->id, 'slideId' => $slide->id], ['class' => 'btn btn-default', 'data-method' => 'post']) ?>
                        <?= Html::a('<i class="fa fa-times-circle"></i>', ['delete-slide', 'id' => $slider->id, 'slideId' => $slide->id], ['class' => 'btn btn-default', 'data-method' => 'post']) ?>
                        <?= Html::a('<i class="fa fa-arrow-circle-right"></i>', ['move-slide-down', 'id' => $slider->id, 'slideId' => $slide->id], ['class' => 'btn btn-default', 'data-method' => 'post']) ?>
                    </div>
                    <br>
                    <?= Html::img($slide->getThumbFileUrl('file', 'main')) ?>
                </div>
                <?php endforeach; ?>
            </div>
            <?php $form = ActiveForm::begin([
                'enableClientValidation' => FALSE,
                'options' => ['enctype' => 'multipart/form-data'],
            ]) ?>
            <?= $form->field($slidesForm, 'files[]')->widget(FileInput::className(), [
                'options' => [
                    'accept' => 'image/*',
                    'multiple' => TRUE,
                ],
            ]) ?>
            <div class="form-group">
                <?= Html::submitButton('Закачать', ['class' => 'btn btn-primary']) ?>
            </div>
            <?php ActiveForm::end() ?>
        </div>
    </div>
</div>
