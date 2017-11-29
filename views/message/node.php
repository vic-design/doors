<?php
/* @var $model \app\fond\forms\manage\MessageForm */

use yii\bootstrap\ActiveForm;
use yii\widgets\MaskedInput;
use yii\helpers\Html;
use yii\helpers\Url;
?>

<?php $form = ActiveForm::begin(['id' => 'messageForm']) ?>

<?= $form->field($model, 'name')->textInput(['maxlength' => TRUE, 'placeholder' => 'ФИО']) ?>
<?= $form->field($model, 'phone')->widget(MaskedInput::className(), [
    'mask' => '+7 (999) 999 99 99',
    'options' => [
        'class' => 'form-control',
        'placeholder' => 'Контактный телефон',
    ],
]) ?>
<?= $form->field($model, 'email')->textInput(['maxlength' => TRUE, 'placeholder' => 'Электронная почта']) ?>
<?= $form->field($model, 'body')->textarea(['rows' => 3, 'placeholder' => 'Ваше сообщение']) ?>
<?= $form->field($model, 'accept')->checkbox() ?>
<div class="form-group">
    <?=Html::submitButton('Отправить', ['class' => 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end() ?>
<p>
    Нажимая кнопку "ОТПРАВИТЬ", Вы автоматически присоединяетесь к <a href="<?= Url::to(['/article/node', 'slug' => 'soglasenie-ob-obrabotke-personalnyh-dannyh']) ?>" target="_blank">"Соглашению об обработке персональных данных"</a> . Если Вы не согласны, то просто покиньте сайт.
</p>
