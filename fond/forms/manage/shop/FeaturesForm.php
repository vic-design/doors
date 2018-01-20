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
    public $describe;
    public $reveal;
    public $opening;
    public $complect;
    public $cam;
    public $packing;
    public $doorInsulation;
    public $boxInsulation;
    public $intensive;
    public $bracing;
    public $weight;

    public function __construct(Product $product = null, array $config = [])
    {
        if ($product){
            $this->features = $product->features;
            $this->innerFacing = $product->inner_facing;
            $this->outFacing = $product->out_facing;
            $this->glass = $product->glass;
            $this->describe = $product->describe;
            $this->reveal =  $product->reveal;
            $this->opening = $product->opening;
            $this->complect = $product->complect;
            $this->cam = $product->cam;
            $this->packing = $product->packing ;
            $this->doorInsulation = $product->door_insulation;
            $this->boxInsulation = $product->box_insulation;
            $this->intensive = $product->intensive;
            $this->bracing = $product->bracing;
            $this->weight = $product->weight;
        }
        parent::__construct($config);
    }

    public function rules()
    {
        return [
            [['innerFacing', 'outFacing', 'glass', 'bracing', 'packing', 'describe'], 'string', 'max' => 255],
            [['features', 'cam', 'doorInsulation', 'boxInsulation', 'intensive', 'opening', 'complect'], 'string'],
            [['weight', 'reveal'], 'number'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'features' => 'Особенности',
            'innerFacing' => 'Внутренняя отделка',
            'outFacing' => 'Внешняя отделка',
            'glass' => 'Стекло',
            'describe' => 'Отделка',
            'reveal' =>  'Ширина наличника',
            'opening' => 'Открывание',
            'cam' => 'Эксцентрик',
            'packing' => 'Уплотнение',
            'doorInsulation' => 'Утепление двери',
            'boxInsulation' => 'Утепление коробки',
            'intensive' => 'Усиление',
            'bracing' => 'Крепление',
            'weight' => 'Вес(кг)',
            'complect' => 'Комплектующие',
        ];
    }
}