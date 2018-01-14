<?php

namespace app\fond\forms\manage\shop;


use app\fond\entities\manage\shop\Product;
use app\fond\entities\manage\shop\Size;
use yii\base\Model;
use yii\helpers\ArrayHelper;

class SizesForm extends Model
{
    public $existing = [];

    public function __construct(Product $product = null, array $config = [])
    {
        if ($product){
            $this->existing = ArrayHelper::getColumn($product->sizeAssignments, 'size_id');
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
            'existing' => 'Список размеров',
        ];
    }

    public function sizeList()
    {
        return ArrayHelper::map(Size::find()->orderBy('name')->all(), 'id', 'name');
    }
}