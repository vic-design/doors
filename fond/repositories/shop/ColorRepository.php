<?php

namespace app\fond\repositories\shop;


use app\fond\entities\manage\shop\Color;
use SebastianBergmann\GlobalState\RuntimeException;
use yii\web\NotFoundHttpException;

class ColorRepository
{
    public function get($id): Color
    {
        if (!$color = Color::findOne($id)){
            throw new NotFoundHttpException('Цвет не найден.');
        }
        return $color;
    }

    public function save(Color $color): void
    {
        if (!$color->save()){
            throw new RuntimeException('Ошибка сохранения.');
        }
    }

    public function remove(Color $color): void
    {
        if (!$color->delete()){
            throw new RuntimeException('Ошибка удаления.');
        }
    }
}