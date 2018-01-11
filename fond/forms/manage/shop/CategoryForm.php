<?php

namespace app\fond\forms\manage\shop;


use app\fond\entities\manage\shop\Category;
use app\fond\validators\SlugValidator;
use yii\base\Model;
use yii\helpers\ArrayHelper;

class CategoryForm extends Model
{
    public $name;
    public $body;
    public $slug;
    public $title;
    public $description;
    public $keywords;
    public $parentId;

    private $_category;

    public function __construct(Category $category = null, array $config = [])
    {
        if ($category){
            $this->name = $category->name;
            $this->body = $category->body;
            $this->slug = $category->slug;
            $this->title = $category->title;
            $this->description = $category->description;
            $this->keywords = $category->keywords;
            $this->parentId = $category->parent ? $category->parent->id : null;
            $this->_category = $category;
        }
        parent::__construct($config);
    }

    public function rules()
    {
        return [
            ['name', 'required'],
            [['name', 'slug', 'title', 'description', 'keywords'], 'string', 'max' => 255],
            ['body', 'string'],
            ['parentId', 'integer'],
            ['slug', SlugValidator::class],
            [['slug'], 'unique', 'targetClass' => Category::class, 'message' => 'Такой alias уже существует.', 'filter' => $this->_category ? ['<>', 'id', $this->_category->id] : null],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Название',
            'body' => 'Описание категории',
            'slug' => 'Алиас',
            'title' => 'МЕТА заголовок',
            'description' => 'МЕТА описание',
            'keywords' => 'МЕТА ключевые слова',
            'parentId' => 'Родительская категория',
        ];
    }

    public function parentCategoryList(): array
    {
        return ArrayHelper::map(Category::find()->orderBy('lft')->asArray()->all(), 'id', function (array $category){
            return ($category['depth'] > 1 ? str_repeat(' -- ', $category['depth'] - 1). '' : '' ) . $category['name'];
        });
    }
}