<?php
/* @var $this \yii\web\View */
/* @var $order \app\fond\order\Order */
/* @var $cart \app\fond\cart\Cart */

use yii\helpers\Html;

$this->title = 'Заказ №'. $order->id .' в интернет магазине &laquo;РД-ТРЕЙДИНГ&raquo;';
?>

<?php $this->beginContent('@app/mail/layouts/html.php') ?>

    <p>
        Вы сделали заказ на сайте РД-ТРЕЙДИНГ. <br>
        Номер Вашего заказа - <strong><?= $order->id ?></strong>
    </p>

    <table style="width: 100%; border: 1px solid #dddddd; border-collapse: collapse">
        <thead>
        <tr style="background-color: #f9f9f9;">
            <th class="text-left" style="padding: 8px; border: 1px solid #dddddd;">Название товара</th>
            <th class="text-left" style="padding: 8px; border: 1px solid #dddddd;">Модель</th>
            <th class="text-left" style="padding: 8px; border: 1px solid #dddddd;">Размер</th>
            <th class="text-left" style="padding: 8px; border: 1px solid #dddddd;">Количество</th>
            <th class="text-right" style="padding: 8px; border: 1px solid #dddddd;">Цена за единицу</th>
            <th class="text-right" style="padding: 8px; border: 1px solid #dddddd;">Общая стоимость</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($order->items as $item): ?>
            <tr>
                <td class="text-left" style="padding: 8px; border: 1px solid #dddddd;">
                    <?= $item->product_name ?>
                </td>
                <td class="text-left" style="padding: 8px; border: 1px solid #dddddd;">
                    <?php if ($item->modification_id): ?>
                        <?= Html::encode($item->modification_name) ?>
                    <?php endif; ?>
                </td>
                <td class="text-left" style="padding: 8px; border: 1px solid #dddddd;">
                    <?= $item->size  ?>
                </td>
                <td class="text-left" style="padding: 8px; border: 1px solid #dddddd;">
                    <?= $item->quantity ?>
                </td>
                <td class="text-right" style="padding: 8px; border: 1px solid #dddddd;">
                    <?= $item->price ?>  руб.
                </td>
                <td class="text-right" style="padding: 8px; border: 1px solid #dddddd;">
                    <?= $item->price * $item->quantity ?>  руб.
                </td>
            </tr>
        <?php endforeach; ?>
        <tr>
            <td colspan="5" style="padding: 8px; border: 1px solid #dddddd;"><strong>ИТОГО</strong></td>
            <td class="text-right" style="padding: 8px; border: 1px solid #dddddd;"><strong><?= $order->cost ?></strong>  руб.</td>
        </tr>
        </tbody>
    </table>

    <p>
        <strong>Информацию о состоянии Вашего заказа Вы будете получать на этот же Email.</strong>
    </p>
    <p style="font-style: italic;">
        Это письмо сгенерировано автоматически. Писать на адрес отправки не надо. Если у вас остались вопросы, Вы можете воспользоваться формой обратной связи на сайте, либо позвонить по указанным на сайте телефонам.
    </p>

<?php $this->endContent() ?>