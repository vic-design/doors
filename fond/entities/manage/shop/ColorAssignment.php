<?php

namespace app\fond\entities\manage\shop;


use yii\db\ActiveRecord;

/**
 * @property int $product_id [int(11)]
 * @property int $color_id [int(11)]
 */
class ColorAssignment extends ActiveRecord
{
    public static function create($colorId): self
    {
        $assignment = new static();
        $assignment->color_id = $colorId;

        return $assignment;
    }

    public function isForColor($id): bool
    {
        return $this->color_id == $id;
    }

    public static function tableName()
    {
        return '{{%product_color_assignments}}';
    }
}