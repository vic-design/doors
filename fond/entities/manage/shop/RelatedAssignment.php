<?php

namespace app\fond\entities\manage\shop;


use yii\db\ActiveRecord;

/**
 * @property int $product_id [int(11)]
 * @property int $related_id [int(11)]
 */
class RelatedAssignment extends ActiveRecord
{
    public static function create($relateId): self
    {
        $relate = new static();
        $relate->related_id = $relateId;

        return $relate;
    }

    public function isForRelate($id): bool
    {
        return $this->related_id == $id;
    }

    public static function tableName()
    {
        return '{{%product_related_assignments}}';
    }
}