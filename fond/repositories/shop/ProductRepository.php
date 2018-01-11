<?php

namespace app\fond\repositories\shop;


use app\fond\entities\manage\shop\Product;
use SebastianBergmann\GlobalState\RuntimeException;
use yii\web\NotFoundHttpException;

class ProductRepository
{
    public function get($id): Product
    {
        if (!$product = Product::findOne($id)){
            throw new NotFoundHttpException('Товар не найден.');
        }
        return $product;
    }

    public function existByMainCategory($id): bool
    {
        return Product::find()->andWhere(['category_id' => $id])->exists();
    }

    public function save(Product $product): void
    {
        if (!$product->save()){
            throw new RuntimeException('Ошибка сохранения.');
        }
    }

    public function remove(Product $product): void
    {
        if (!$product->delete()){
            throw new RuntimeException('Ошибка удаления.');
        }
    }
}