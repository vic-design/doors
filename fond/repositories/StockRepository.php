<?php

namespace app\fond\repositories;


use app\fond\entities\manage\Stock;
use yii\web\NotFoundHttpException;

class StockRepository
{
    public function get($id): Stock
    {
        if (!$stock = Stock::findOne($id)){
            throw new NotFoundHttpException('Акция не найдена.');
        }
        return $stock;
    }

    public function save(Stock $stock)
    {
        if (!$stock->save()){
            throw new \RuntimeException('Ошибка сохранения.');
        }
    }

    public function remove(Stock $stock)
    {
        if (!$stock->delete()){
            throw new \RuntimeException('Ошибка удаления');
        }
    }
}