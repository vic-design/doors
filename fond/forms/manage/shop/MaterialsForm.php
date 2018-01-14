<?php

namespace app\fond\forms\manage\shop;


use app\fond\entities\manage\shop\Material;
use app\fond\entities\manage\shop\Product;
use yii\base\Model;
use yii\helpers\ArrayHelper;

class MaterialsForm extends Model
{
    public $existing = [];

    public function __construct(Product $product = null, array $config = [])
    {
        if ($product){
            $this->existing = ArrayHelper::getColumn($product->materialAssignments, 'material_id');
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
            'existing' => 'Список материалов',
        ];
    }

    public function materialList()
    {
        return ArrayHelper::map(Material::find()->orderBy('name')->all(), 'id', 'name');
    }
}