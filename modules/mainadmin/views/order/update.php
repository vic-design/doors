<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model \app\fond\forms\shop\OrderEditForm */
/* @var $order \app\fond\order\Order */

$this->title = 'Редактирование заказа: ' . $order->id;
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $order->id, 'url' => ['view', 'id' => $order->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="order-update">

    <?php $form = ActiveForm::begin() ?>
    <div class="box">
        <div class="box-header with-border">Заказ</div>
        <div class="box-body">
            <?= $form->field($model, 'customerName')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'customerPhone')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'customerEmail')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'note')->textarea(['rows' => 3]) ?>
        </div>
    </div>

    <?php if ($order->status == 4): ?>
        <div class="box" id="cancelled-reason">
            <div class="box-header with-border">Причина отказа</div>
            <div class="box-body">
                <?= $form->field($model, 'cancelledReason')->label(false)->textarea(['rows' => 3]) ?>
            </div>
        </div>
    <?php endif; ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end() ?>

</div>
