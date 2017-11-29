<?php

namespace app\fond\helpers;


use app\fond\entities\manage\Stock;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

class StockHelper
{
    public static function statusList()
    {
        return [
            Stock::STATUS_DRAFT => 'Отключено',
            Stock::STATUS_ACTIVE => 'Опубликовано',
        ];
    }

    public static function statusLabel($status)
    {
        switch ($status){
            case Stock::STATUS_DRAFT :
                $class = 'label label-default'; break;
            case Stock::STATUS_ACTIVE :
                $class = 'label label-success'; break;
            default:
                $class = 'label label-default';
        }
        return Html::tag('span', ArrayHelper::getValue(self::statusList(), $status), ['class' => $class]);
    }
}