<?php

namespace app\fond\entities\manage\shop;


use yii\db\ActiveRecord;

/**
 * @property int $id [int(11)]
 * @property string $name [varchar(255)]
 */
class Material extends ActiveRecord
{
    public static function create($name): self
    {
        $material = new static();
        $material->name = $name;

        return $material;
    }

    public function edit($name): void
    {
        $this->name = $name;
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Название',
        ];
    }

    public static function tableName()
    {
        return '{{%product_materials}}';
    }
}