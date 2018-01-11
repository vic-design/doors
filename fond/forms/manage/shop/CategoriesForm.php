<?php

namespace app\fond\forms\manage\shop;


use app\fond\entities\manage\shop\Category;
use app\fond\entities\manage\shop\Product;
use yii\base\Model;
use yii\helpers\ArrayHelper;

class CategoriesForm extends Model
{
    public $main;
    public $others = [];

    public function __construct(Product $product = null, array $config = [])
    {
        if ($product){
            $this->main = $product->category_id;
            $this->others = ArrayHelper::getColumn($product->categoryAssignments, 'category_id');
        }
        parent::__construct($config);
    }

    public function rules()
    {
        return [
            ['main', 'required'],
            ['main', 'integer'],
            ['others', 'each', 'rule' => ['integer']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'main' => 'Основная категория',
            'others' => 'Дополнительные категории',
        ];
    }

    public function categoriesList(): array
    {
        return ArrayHelper::map(Category::find()->andWhere(['>', 'depth', 0])->orderBy('lft')->asArray()->all(), 'id', function (array $category){
           return ($category['depth'] > 1 ? str_repeat(' -- ', $category['depth'] - 1). '' : ''). $category['name'];
        });
    }
}