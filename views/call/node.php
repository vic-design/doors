<?php
/* @var $model \app\fond\forms\manage\CallForm */

use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\MaskedInput;

?>

<?php $form = ActiveForm::begin(['id' => 'measureForm']) ?>

<?= $form->field($model, 'name')->textInput(['maxlength' => TRUE, 'placeholder' => 'ФИО']) ?>
<?= $form->field($model, 'phone')->widget(MaskedInput::className(), [
    'mask' => '+7 (999) 999 99 99',
    'options' => [
        'class' => 'form-control',
        'placeholder' => 'Контактный телефон',
    ],
]) ?>
<?= $form->field($model, 'accept')->checkbox() ?>
<div class="form-group">
    <?= Html::submitButton('Вызвать замерщика', ['class' => 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end() ?>
<p>
    <a href="<?= Url::to(['/article/node', 'slug' => 'soglasenie-ob-obrabotke-personalnyh-dannyh']) ?>" target="_blank">
        "Соглашение об обработке персональных данных"
    </a>
</p>
