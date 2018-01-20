<?php

namespace app\fond\entities\manage\shop;


use yii\db\ActiveRecord;

/**
 * @property int $product_id [int(11)]
 * @property int $additional_id [int(11)]
 */
class AdditionalAssignment extends ActiveRecord
{
    public static function create($additionalId): self
    {
        $additional = new static();
        $additional->additional_id = $additionalId;

        return $additional;
    }

    public function isForAddition($id): bool
    {
        return $this->additional_id == $id;
    }

    public static function tableName()
    {
        return '{{%additional_assignments}}';
    }
}