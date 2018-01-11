<?php

namespace app\fond\forms\manage\shop;


use app\fond\entities\manage\shop\Product;
use yii\base\Model;

class ThicknessForm extends Model
{
    public $doorThickness;
    public $doorFrameThickness;
    public $doorSteelThickness;
    public $frameSteelThickness;

    public function __construct(Product $product = null, array $config = [])
    {
        if ($product){
            $this->doorThickness = $product->door_thickness;
            $this->doorFrameThickness = $product->door_frame_thickness;
            $this->doorSteelThickness = $product->door_steel_thickness;
            $this->frameSteelThickness = $product->frame_steel_thickness;
        }
        parent::__construct($config);
    }

    public function rules()
    {
        return [
            [['doorThickness', 'doorFrameThickness', 'doorSteelThickness', 'frameSteelThickness'], 'number'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'doorThickness' => 'Толщина полотна',
            'doorFrameThickness' => 'Толщина коробки',
            'doorSteelThickness' => 'Толщина стали полотна',
            'frameSteelThickness' => 'Толщина стали коробки',
        ];
    }
}