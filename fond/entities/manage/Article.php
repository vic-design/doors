<?php


namespace app\fond\entities\manage;


use yii\db\ActiveRecord;

/**
 * @property int $id [int(11)]
 * @property string $name [varchar(255)]
 * @property string $body
 * @property string $slug [varchar(255)]
 * @property int $status [smallint(6)]
 * @property string $title [varchar(255)]
 * @property string $description [varchar(255)]
 * @property string $keywords [varchar(255)]
 * @property int $created_at [int(11)]
 * @property int $updated_at [int(11)]
 */
class Article extends ActiveRecord
{
    const STATUS_DRAFT = 0;
    const STATUS_ACTIVE = 1;

    public static function create($name, $body, $slug, $title, $description, $keywords): self
    {
        $article = new static();
        $article->name = $name;
        $article->body = $body;
        $article->slug = $slug;
        $article->title = $title;
        $article->description = $description;
        $article->keywords = $keywords;
        $article->status = self::STATUS_DRAFT;
        $article->created_at = time();

        return $article;
    }

    public function edit($name, $body, $slug, $title, $description, $keywords)
    {
        $this->name = $name;
        $this->body = $body;
        $this->slug = $slug;
        $this->title = $title;
        $this->description = $description;
        $this->keywords = $keywords;
        $this->updated_at = time();
    }

    public function isDraft()
    {
        return $this->status == self::STATUS_DRAFT;
    }

    public function isActive()
    {
        return $this->status == self::STATUS_ACTIVE;
    }

    public function draft()
    {
        if ($this->isDraft()){
            throw new \DomainException('Статья уже снята с публикации.');
        }
        $this->status = self::STATUS_DRAFT;
    }

    public function activate()
    {
        if ($this->isActive()){
            throw new \DomainException('Статья уже опубликована.');
        }
        $this->status = self::STATUS_ACTIVE;
    }

    public function attributeLabels() {
        return [
            'name' => 'Заголовок',
            'body' => 'Текст',
            'slug' => 'Алиас',
            'title' => 'Мета заголовок',
            'status' => 'Состояние',
            'description' => 'Мета описание',
            'keywords' => 'Ключевые слова',
            'created_at' => 'Создано',
            'updated_at' => 'Обновлено',
        ];
    }

    public static function tableName() {
        return '{{%articles}}';
    }
}