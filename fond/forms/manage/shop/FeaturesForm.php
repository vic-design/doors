<?php

namespace app\fond\forms\manage\shop;


use app\fond\entities\manage\shop\Product;
use yii\base\Model;

class FeaturesForm extends Model
{
    public $features;
    public $innerFacing;
    public $outFacing;
    public $glass;

    public function __construct(Product $product = null, array $config = [])
    {
        if ($product){
            $this->features = $product->features;
            $this->innerFacing = $product->inner_facing;
            $this->outFacing = $product->out_facing;
            $this->glass = $product->glass;
        }
        parent::__construct($config);
    }

    public function rules()
    {
        return [
            [['innerFacing', 'outFacing', 'glass'], 'string', 'max' => 255],
            ['features', 'string'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'features' => 'Особенности',
            'innerFacing' => 'Внутренняя отделка',
            'outFacing' => 'Внешняя отделка',
            'glass' => 'Стекло',
        ];
    }
}