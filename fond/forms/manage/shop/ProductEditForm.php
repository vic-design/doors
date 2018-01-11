<?php

namespace app\fond\forms\manage\shop;


use app\fond\entities\manage\shop\Product;
use app\fond\validators\SlugValidator;
use elisdn\compositeForm\CompositeForm;

/**
 * @property CategoriesForm $categories
 */
class ProductEditForm extends CompositeForm
{
    public $name;
    public $code;
    public $body;
    public $slug;
    public $title;
    public $description;
    public $keywords;

    private $_product;

    public function __construct(Product $product, array $config = [])
    {
        $this->name = $product->name;
        $this->code = $product->code;
        $this->body = $product->body;
        $this->slug = $product->slug;
        $this->title = $product->title;
        $this->description = $product->description;
        $this->keywords = $product->keywords;
        $this->_product = $product;
        $this->categories = new CategoriesForm($product);
        parent::__construct($config);
    }

    public function rules()
    {
        return [
            [['name', 'code'], 'required'],
            [['name', 'code', 'slug', 'title', 'description', 'keywords'], 'string', 'max' => 255],
            ['body', 'string'],
            ['slug', SlugValidator::class],
            [['alias', 'code'], 'unique', 'targetClass' => Product::class, 'filter' => $this->_product ? ['<>', 'id', $this->_product->id] : null],
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
        return ['categories',];
    }
}