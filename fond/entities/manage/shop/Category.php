<?php

namespace app\fond\entities\manage\shop;


use app\fond\entities\manage\shop\queries\CategoryQuery;
use paulzi\nestedsets\NestedSetsBehavior;
use yii\db\ActiveRecord;

/**
 * @property int $id [int(11)]
 * @property string $name [varchar(255)]
 * @property string $body
 * @property string $slug [varchar(255)]
 * @property string $title [varchar(255)]
 * @property string $description [varchar(255)]
 * @property string $keywords [varchar(255)]
 * @property int $lft [int(11)]
 * @property int $rgt [int(11)]
 * @property int $depth [int(11)]
 *
 * @property Category $parent
 * @property Category $next
 * @property Category $prev
 * @mixin NestedSetsBehavior
 * @property Category[] $parents
 * @property Category[] descedants
 * @property Category[] descendants
 */
class Category extends ActiveRecord
{
    public static function create($name, $body, $slug, $title, $description, $keywords): self
    {
        $category = new static();
        $category->name = $name;
        $category->body = $body;
        $category->slug = $slug;
        $category->title = $title;
        $category->description = $description;
        $category->keywords = $keywords;

        return $category;
    }

    public function edit($name, $body, $slug, $title, $description, $keywords)
    {
        $this->name = $name;
        $this->body = $body;
        $this->slug = $slug;
        $this->title = $title;
        $this->description = $description;
        $this->keywords = $keywords;
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
        ];
    }

    public function behaviors()
    {
        return [
            NestedSetsBehavior::className(),
        ];
    }

    public function transactions()
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }

    public static function tableName()
    {
        return '{{%shop_categories}}';
    }

    public static function find(): CategoryQuery
    {
        return new CategoryQuery(static::class);
    }
}