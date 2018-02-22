<?php

namespace app\fond\helpers;


use app\fond\order\Order;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

class OrderHelper
{
    public static function statusList(): array
    {
        return [
            Order::NEW => 'Новый заказ',
            Order::COMPLETED => 'Заказ укомплектован',
            Order::SENT => 'Заказ отправлен',
            Order::CANCELLED => 'Заказ анулирован',
        ];
    }

    public static function statusName($status): string
    {
        return ArrayHelper::getValue(self::statusList(), $status);
    }

    public static function statusLabel($status): string
    {
        switch ($status){
            case Order::NEW :
                $class = 'label label-primary'; break;
            case Order::COMPLETED :
                $class = 'label label-warning'; break;
            case Order::SENT :
                $class = 'label label-success'; break;
            case Order::CANCELLED :
                $class = 'label label-danger'; break;
            default:
                $class = 'label label-default';
        }
        return Html::tag('span', ArrayHelper::getValue(self::statusList(), $status), ['class' => $class]);
    }
}