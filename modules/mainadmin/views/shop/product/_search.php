<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\mainadmin\forms\ProductSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'category_id') ?>

    <?= $form->field($model, 'main_photo_id') ?>

    <?= $form->field($model, 'code') ?>

    <?php // echo $form->field($model, 'body') ?>

    <?php // echo $form->field($model, 'door_old_price') ?>

    <?php // echo $form->field($model, 'box_old_price') ?>

    <?php // echo $form->field($model, 'box_price') ?>

    <?php // echo $form->field($model, 'price') ?>

    <?php // echo $form->field($model, 'slug') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'door_thickness') ?>

    <?php // echo $form->field($model, 'door_frame_thickness') ?>

    <?php // echo $form->field($model, 'door_steel_thickness') ?>

    <?php // echo $form->field($model, 'frame_steel_thickness') ?>

    <?php // echo $form->field($model, 'features') ?>

    <?php // echo $form->field($model, 'inner_facing') ?>

    <?php // echo $form->field($model, 'out_facing') ?>

    <?php // echo $form->field($model, 'glass') ?>

    <?php // echo $form->field($model, 'title') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'keywords') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
