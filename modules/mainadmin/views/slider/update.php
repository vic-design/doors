<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $slider app\fond\entities\manage\Slider */
/* @var $model \app\fond\forms\manage\SliderEditForm */

$this->title = 'Редактирование слайдера: ' . $slider->name;
$this->params['breadcrumbs'][] = ['label' => 'Слайдеры', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $slider->name, 'url' => ['view', 'id' => $slider->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="slider-update">

    <?php $form = ActiveForm::begin() ?>

    <div class="box">
        <div class="box-body">
            <?= $form->field($model, 'name')->textInput(['maxlength' => TRUE]) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end() ?>

</div>
