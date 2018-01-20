<?php

namespace app\fond\forms\manage\shop;


use app\fond\entities\manage\shop\Category;
use app\fond\entities\manage\shop\Product;
use yii\base\Model;
use yii\helpers\ArrayHelper;

class AdditionsForm extends Model
{
    public $existing = [];

    public function __construct(Product $product = null, array $config = [])
    {
        if ($product){
            $this->existing = ArrayHelper::getColumn($product->additionalAssignments, 'additional_id');
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
            'existing' => 'Список дополнительных товаров',
        ];
    }

    public function additionalList()
    {
        $category = Category::findOne(127);
        $query = Product::find()->alias('p')->active('p')->with('category');
        $idx = ArrayHelper::merge([$category->id], $category->getDescendants()->select('id')->column());
        $query->joinWith(['categoryAssignments ca'], false);
        $query->andWhere(['or', ['p.category_id' => $idx], ['ca.category_id' => $idx]]);
        $query->groupBy('p.id');
        $products = $query->all();
        return ArrayHelper::map($products, 'id', 'name');
    }
}