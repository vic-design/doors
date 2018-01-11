<?php

namespace app\fond\helpers;

use app\fond\entities\manage\shop\Product;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

class ProductHelper
{
    public static function statusList(): array
    {
        return [
            Product::STATUS_DRAFT => 'Отключен',
            Product::STATUS_ACTIVE => 'Активный',
        ];
    }

    public static function statusLabel($status): string
    {
        switch ($status){
            case Product::STATUS_DRAFT :
                $class = 'label label-danger'; break;
            case Product::STATUS_ACTIVE :
                $class = 'label label-success'; break;
            default:
                $class = 'label label-default';
        }
        return Html::tag('span', ArrayHelper::getValue(self::statusList(), $status), ['class' => $class]);
    }
}