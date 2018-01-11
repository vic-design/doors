<?php

namespace app\fond\entities\manage\shop;


use yii\db\ActiveRecord;
use yii\web\UploadedFile;
use yiidreamteam\upload\ImageUploadBehavior;

/**
 * @property UploadedFile file
 * @property int $id [int(11)]
 * @property int $product_id [int(11)]
 * @property int $sort [int(11)]
 */
class Photo extends ActiveRecord
{
    public static function create(UploadedFile $file): self
    {
        $photo = new static();
        $photo->file = $file;

        return $photo;
    }

    public function setSort($sort): void
    {
        $this->sort = $sort;
    }

    public function isEqualTo($id): bool
    {
        return $this->id == $id;
    }

    public function attributeLabels()
    {
        return [
            'file' => 'Фотография',
        ];
    }

    public static function tableName()
    {
        return '{{%shop_product_photos}}';
    }

    public function behaviors()
    {
        return [
            'class' => ImageUploadBehavior::class,
            'attribute' => 'file',
            'createThumbsOnRequest' => true,
            'filePath' => '@webroot/files/product/origin/[[attribute_product_id]]/[[id]].[[extension]]',
            'fileUrl' => '@web/files/product/origin/[[attribute_product_id]]/[[id]].[[extension]]',
            'thumbPath' => '@webroot/files/product/cache/[[profile]]/[[id]].[[extension]]',
            'thumbUrl' => '@web/files/product/cache/[[profile]]/[[id]].[[extension]]',
            'thumbs' => [
                'admin' => ['width' => 330, 'height' => 100],
            ],
        ];
    }
}