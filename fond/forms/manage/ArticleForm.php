<?php

namespace app\fond\forms\manage;


use app\fond\validators\SlugValidator;
use app\fonds\entities\manage\Article;
use yii\base\Model;

class ArticleForm extends Model
{
    public $name;
    public $body;
    public $slug;
    public $title;
    public $description;
    public $keywords;

    private $_article;

    public function __construct(Article $article = NULL, array $config = []) {
        if ($article){
            $this->name = $article->name;
            $this->body = $article->body;
            $this->slug = $article->slug;
            $this->title = $article->title;
            $this->description = $article->description;
            $this->keywords = $article->keywords;

            $this->_article = $article;
        }
        parent::__construct($config);
    }

    public function rules() {
        return [
            ['name', 'required'],
            [['name', 'slug', 'title', 'description', 'keywords'], 'string', 'max' => 255],
            ['body', 'string'],
            ['slug', SlugValidator::class],
            [['name', 'slug'], 'unique', 'targetClass' => Article::class, 'filter' => $this->_article ? ['<>', 'id', $this->_article->id] : NULL],
        ];
    }

    public function attributeLabels() {
        return [
            'name' => 'Заголовок',
            'body' => 'Текст',
            'slug' => 'Алиас',
            'title' => 'Мета заголовок',
            'description' => 'Мета описание',
            'keywords' => 'Ключевые слова',
        ];
    }
}