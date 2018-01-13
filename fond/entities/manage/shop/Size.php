<?php

namespace app\fond\entities\manage\shop;


use yii\db\ActiveRecord;

/**
 * @property int $id [int(11)]
 * @property string $name [varchar(255)]
 */
class Size extends ActiveRecord
{
    public static function create($name): self
    {
        $size = new static();
        $size->name = $name;

        return $size;
    }

    public function edit($name): void
    {
        $this->name = $name;
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Размер',
        ];
    }

    public static function tableName()
    {
        return '{{%product_size}}';
    }
}