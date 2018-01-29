<?php

namespace app\fond\forms\shop;


use app\fond\entities\manage\shop\Modification;
use app\fond\entities\manage\shop\Product;
use yii\base\Model;
use yii\helpers\ArrayHelper;

class AddToCartForm extends Model
{
    public $modification;
    public $quantity;
    public $size;

    private $_product;

    public function __construct(Product $product, array $config = [])
    {
        $this->_product = $product;
        $this->quantity = 1;
        parent::__construct($config);
    }

    public function rules()
    {
        return array_filter([
            $this->_product->modifications ? ['modification', 'integer'] : false,
            $this->_product->sizes ? ['size', 'required'] : false,
            ['quantity', 'required'],
            ['quantity', 'integer', 'min' => 1],
        ]) ;
    }

    public function attributeLabels()
    {
        return [
            'modification' => 'Выбрать модель товара',
            'quantity' => 'Количество',
            'size' => 'Выбрать размер',
        ];
    }

    public function modificationsList(): array
    {
        return  ArrayHelper::map($this->_product->modifications, 'id', function (Modification $modification){
           return $modification->additional_name . ' | Цена - ' . $modification->price;
        });
    }

    public function sizeList(): array
    {
        return ArrayHelper::map($this->_product->sizes, 'id', 'name');
    }
}