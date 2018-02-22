<?php
/* @var $this \yii\web\View */
/* @var $order \app\fond\order\Order */

use yii\helpers\Html;

$this->title = 'Ваш заказ №'. $order->id .' укомплектован';
?>

<h1><?= Html::encode($this->title) ?></h1>

<p>
    Сообщаем Вам что <strong>заказ №<?= $order->id ?></strong> укомплектован.
</p>
<p>
    Дополнительную информацию Вы можете получить, воспользовавшись формой обратной связи нашего сайта или телефонами для связи.
</p>
<h2 style="text-align: center;">ИНТЕРНЕТ МАГАЗИН <?= \Yii::$app->name ?></h2>

<p style="font-style: italic;">
    Это письмо сгенерировано автоматически. Отвечать на него, или писать на адрес отправки - бесполезно.
</p>
