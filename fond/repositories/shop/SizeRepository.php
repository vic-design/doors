<?php

namespace app\fond\repositories\shop;


use app\fond\entities\manage\shop\Size;
use SebastianBergmann\GlobalState\RuntimeException;
use yii\web\NotFoundHttpException;

class SizeRepository
{
    public function get($id): Size
    {
        if (!$size = Size::findOne($id)){
            throw new NotFoundHttpException('Размер не найден.');
        }
        return $size;
    }

    public function save(Size $size): void
    {
        if (!$size->save()){
            throw new RuntimeException('Ошибка сохранения.');
        }
    }

    public function remove(Size $size): void
    {
        if (!$size->delete()){
            throw new RuntimeException('Ошибка удаления.');
        }
    }
}