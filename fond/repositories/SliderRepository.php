<?php

namespace app\fond\repositories;


use app\fond\entities\manage\Slider;
use yii\web\NotFoundHttpException;

class SliderRepository
{
    public function get($id): Slider
    {
        if (!$slider = Slider::findOne($id)){
            throw new NotFoundHttpException('Слайдер не найден.');
        }
        return $slider;
    }

    public function save(Slider $slider)
    {
        if (!$slider->save()){
            throw new \DomainException('Ошибка сохранения');
        }
    }

    public function remove(Slider $slider)
    {
        if (!$slider->delete()){
            throw new \DomainException('Ошибка удаления');
        }
    }
}