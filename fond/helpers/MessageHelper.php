<?php

namespace app\fond\helpers;


use app\fond\entities\manage\Message;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

class MessageHelper
{
    public static function statusList(): array
    {
        return [
            Message::STATUS_DRAFT => 'Не прочитано',
            Message::STATUS_ACTIVE => 'Прочитано',
        ];
    }

    public static function statusLabel($status)
    {
        switch ($status){
            case Message::STATUS_DRAFT :
                $class = 'label label-danger'; break;
            case Message::STATUS_ACTIVE :
                $class = 'label label-default'; break;
            default:
                $class = 'label label-default';
        }
        return Html::tag('span', ArrayHelper::getValue(self::statusList(), $status), ['class' => $class]);
    }
}