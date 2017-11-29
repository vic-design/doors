<?php

namespace app\fond\forms\manage;


use app\fond\entities\manage\Stock;
use app\fond\validators\SlugValidator;
use yii\base\Model;

class StockForm extends Model
{
    public $name;
    public $start_day;
    public $summary;
    public $body;
    public $slug;
    public $title;
    public $description;
    public $keywords;

    private $_stock;

    public function __construct(Stock $stock = NULL, array $config = []) {
        if ($stock){
            $this->name = $stock->name;
            $this->start_day = $stock->start_day;
            $this->summary = $stock->summary;
            $this->body = $stock->body;
            $this->slug = $stock->slug;
            $this->title = $stock->title;
            $this->description = $stock->description;
            $this->keywords = $stock->keywords;
            $this->_stock = $stock;
        }
        parent::__construct($config);
    }

    public function rules() {
        return [
            ['name', 'required'],
            [['name', 'start_day', 'slug', 'title', 'description', 'keywords'], 'string', 'max' => 255],
            [['summary', 'body'], 'string'],
            ['slug', SlugValidator::class],
            [['name', 'slug'], 'unique', 'targetClass' => Stock::class, 'filter' => $this->_stock ? ['<>', 'id', $this->_stock->id] : NULL],
        ];
    }

    public function attributeLabels() {
        return [
            'name' => 'Название',
            'start_day' => 'Дата начала',
            'summary' => 'Анонс',
            'body' => 'Текст акции',
            'slug' => 'Алиас',
            'title' => 'Мета заголовок',
            'description' => 'Мета описание',
            'keywords' => 'Ключевые слова',
        ];
    }
}