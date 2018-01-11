<?php

namespace app\fond\forms\manage\shop;


use app\fond\entities\manage\shop\Product;
use app\fond\validators\SlugValidator;
use elisdn\compositeForm\CompositeForm;

/**
 * @property PriceForm $price
 * @property ThicknessForm $thickness
 * @property FeaturesForm $features
 * @property PhotosForm $photos
 * @property CategoriesForm $categories
 */
class ProductCreateForm extends CompositeForm
{
    public $name;
    public $code;
    public $body;
    public $slug;
    public $title;
    public $description;
    public $keywords;

    public function __construct(array $config = [])
    {
        $this->categories = new CategoriesForm();
        $this->price = new PriceForm();
        $this->thickness = new ThicknessForm();
        $this->features = new FeaturesForm();
        $this->photos = new PhotosForm();
        parent::__construct($config);
    }

    public function rules()
    {
        return [
            [['name', 'code'], 'required'],
            [['name', 'code', 'slug', 'title', 'description', 'keywords'], 'string', 'max' => 255],
            ['body', 'string'],
            ['slug', SlugValidator::class],
            [['name', 'slug', 'code'], 'unique', 'targetClass' => Product::class],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Название',
            'code' => 'Артикул',
            'body' => 'Описание',
            'slug' => 'Алиас',
            'title' => 'МЕТА заголовок',
            'description' => 'МЕТА описание',
            'keywords' => 'МЕТА ключевые слова',
        ];
    }

    protected function internalForms()
    {
        return [
            'price', 'thickness', 'features', 'photos', 'categories',
        ];
    }
}