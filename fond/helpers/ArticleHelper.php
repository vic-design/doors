<?php

namespace app\fond\helpers;


use app\fond\entities\manage\Article;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

class ArticleHelper
{
    public static function statusList()
    {
        return [
            Article::STATUS_DRAFT => 'Снято с публикации.',
            Article::STATUS_ACTIVE => 'Опубликовано',
        ];
    }

    public static function statusLabel($status)
    {
        switch ($status){
            case Article::STATUS_DRAFT :
                $class = 'label label-danger'; break;
            case Article::STATUS_ACTIVE :
                $class = 'label label-success'; break;
            default:
                $class = 'label label-default';
        }
        return Html::tag('span', ArrayHelper::getValue(self::statusList(), $status), ['class' => $class]);
    }
}