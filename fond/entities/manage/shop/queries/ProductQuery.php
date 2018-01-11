<?php

namespace app\fond\entities\manage\shop\queries;


use app\fond\entities\manage\shop\Product;
use yii\db\ActiveQuery;

class ProductQuery extends ActiveQuery
{
    public function active($alias = null){
        return $this->andWhere([($alias ? $alias . '.' : ''). 'status' => Product::STATUS_ACTIVE]);
    }
}