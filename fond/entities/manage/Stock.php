<?php

namespace app\fond\entities\manage;


use yii\db\ActiveRecord;

/**
 * @property int $id [int(11)]
 * @property string $name [varchar(255)]
 * @property string $start_day [varchar(255)]
 * @property string $summary
 * @property string $body
 * @property int $status [smallint(6)]
 * @property int $created_at [int(11)]
 * @property int $updated_at [int(11)]
 * @property string $title [varchar(255)]
 * @property string $description [varchar(255)]
 * @property string $keywords [varchar(255)]
 * @property string $slug [varchar(255)]
 */
class Stock extends ActiveRecord
{
    const STATUS_DRAFT = 0;
    const STATUS_ACTIVE = 1;

    public static function create($name, $start_day, $summary, $body, $slug, $title, $description, $keywords): self
    {
        $stock = new static();
        $stock->name = $name;
        $stock->start_day = $start_day;
        $stock->summary = $summary;
        $stock->body = $body;
        $stock->slug = $slug;
        $stock->title = $title;
        $stock->description = $description;
        $stock->keywords = $keywords;
        $stock->status = self::STATUS_DRAFT;
        $stock->created_at = time();

        return $stock;
    }

    public function edit($name, $start_day, $summary, $body, $slug, $title, $description, $keywords)
    {
        $this->name = $name;
        $this->start_day = $start_day;
        $this->summary = $summary;
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
            throw new \DomainException('Акция уже снята с публикации.');
        }
        $this->status = self::STATUS_DRAFT;
    }

    public function activate()
    {
        if ($this->isActive()){
            throw new \DomainException('Акция уже опубликована.');
        }
    }

    public function attributeLabels() {
        return [
            'name' => 'Название',
            'start_day' => 'Дата начала',
            'summary' => 'Анонс',
            'body' => 'Текст акции',
            'slug' => 'Алиас',
            'status' => 'Состояние',
            'created_at' => 'Создано',
            'updated_at' => 'Обновлено',
            'title' => 'Мета заголовок',
            'description' => 'Мета описание',
            'keywords' => 'Ключевые слова',
        ];
    }

    public static function tableName() {
        return '{{%stocks}}';
    }
}