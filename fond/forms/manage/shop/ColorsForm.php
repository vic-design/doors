<?php

namespace app\fond\forms\manage\shop;


use app\fond\entities\manage\shop\Color;
use app\fond\entities\manage\shop\Product;
use yii\base\Model;
use yii\helpers\ArrayHelper;

class ColorsForm extends Model
{
    public $existing = [];

    public function __construct(Product $product = null, array $config = [])
    {
        if ($product){
            $this->existing = ArrayHelper::getColumn($product->colorAssignments, 'color_id');
        }
        parent::__construct($config);
    }

    public function rules()
    {
        return [
            ['existing', 'each', 'rule' => ['integer']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'existing' => 'Список цветов',
        ];
    }

    public function colorList()
    {
        return ArrayHelper::map(Color::find()->orderBy('name')->all(), 'id', 'name');
    }
}