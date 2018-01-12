<?php

namespace app\fond\entities\manage\shop;


use yii\db\ActiveRecord;

/**
 * @property int $product_id [int(11)]
 * @property int $material_id [int(11)]
 */
class MaterialAssignment extends ActiveRecord
{
    public static function create($material_id): self
    {
        $assignment = new static();
        $assignment->material_id = $material_id;

        return $assignment;
    }

    public function isForMaterial($id): bool
    {
        return $this->material_id == $id;
    }

    public static function tableName()
    {
        return '{{%product_material_assignments}}';
    }
}