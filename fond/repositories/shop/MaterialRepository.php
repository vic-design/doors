<?php

namespace app\fond\repositories\shop;


use app\fond\entities\manage\shop\Material;
use SebastianBergmann\GlobalState\RuntimeException;
use yii\web\NotFoundHttpException;

class MaterialRepository
{
    public function get($id): Material
    {
        if (!$material = Material::findOne($id)){
            throw new NotFoundHttpException('Материал не найден.');
        }
        return $material;
    }
    
    public function save(Material $material): void
    {
        if (!$material->save()){
            throw new RuntimeException('Ошибка сохранения.');
        }
    }
    
    public function remove(Material $material): void
    {
        if (!$material->delete()){
            throw new RuntimeException('Ошибка удаления.');
        }
    }
}