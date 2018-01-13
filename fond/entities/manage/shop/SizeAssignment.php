<?php

namespace app\fond\entities\manage\shop;


use yii\db\ActiveRecord;

/**
 * @property int $product_id [int(11)]
 * @property int $size_id [int(11)]
 */
class SizeAssignment extends ActiveRecord
{
    public static function create($sizeId): self
    {
        $assignment = new static();
        $assignment->size_id = $sizeId;

        return $assignment;
    }

    public function isForSize($id): bool
    {
        return $this->size_id == $id;
    }

    public static function tableName()
    {
        return '{{%size_assignments}}';
    }
}