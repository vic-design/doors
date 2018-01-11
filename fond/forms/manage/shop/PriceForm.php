<?php

namespace app\fond\forms\manage\shop;


use app\fond\entities\manage\shop\Product;
use yii\base\Model;

class PriceForm extends Model
{
    public $doorOldPrice;
    public $boxOldPrice;
    public $boxPrice;
    public $price;

    public function __construct(Product $product = null, array $config = [])
    {
        if ($product){
            $this->doorOldPrice = $product->door_old_price;
            $this->boxOldPrice = $product->box_old_price;
            $this->boxPrice = $product->box_price;
            $this->price = $product->price;
        }
        parent::__construct($config);
    }

    public function rules()
    {
        return [
            ['price', 'required'],
            [['price', 'boxPrice', 'boxOldPrice', 'doorOldPrice'], 'integer', 'min' => 0],
        ];
    }

    public function attributeLabels()
    {
        return [
            'doorOldPrice' => 'Старая цена на полотно',
            'boxOldPrice' => 'Старая цена за комплект',
            'boxPrice' => 'Цена за комплект',
            'price' => 'Цена товара',
        ];
    }
}