<?php

namespace app\fond\entities\manage\shop;


use yii\db\ActiveRecord;
use yii\web\UploadedFile;
use yiidreamteam\upload\ImageUploadBehavior;

/**
 * @property int $id [int(11)]
 * @property int $product_id [int(11)]
 * @property string $name [varchar(255)]
 * @property string $additional_name [varchar(255)]
 * @property string $code [varchar(255)]
 * @property int $price [int(11)]
 * @property string $photo [varchar(255)]
 */
class Modification extends ActiveRecord
{
    public static function create($id, $name, $additionalName, $code, $price): self
    {
        $modification = new static();
        $modification->id = $id;
        $modification->name = $name;
        $modification->additional_name = $additionalName;
        $modification->code = $code;
        $modification->price = $price;

        return $modification;
    }

    public function setPhoto(UploadedFile $photo): void
    {
        $this->photo = $photo;
    }

    public function edit($name, $additionalName, $code, $price): void
    {
        $this->name = $name;
        $this->additional_name = $additionalName;
        $this->code = $code;
        $this->price = $price;
    }

    public function isEqualTo($id): bool
    {
        return $this->id == $id;
    }

    public function isCodeEqualTo($code): bool
    {
        return $this->code === $code;
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Название',
            'additionalName' => 'Доп. название',
            'additional_name' => 'Доп. название',
            'code' => 'Артикул',
            'price' => 'Цена',
            'photo' => 'Фото',
        ];
    }

    public static function tableName()
    {
        return '{{%product_modifications}}';
    }

    public function behaviors()
    {
        return [
            [
                'class' => ImageUploadBehavior::className(),
                'attribute' => 'photo',
                'createThumbsOnRequest' => true,
                'filePath' => '@webroot/files/modifications/origin/[[id]].[[extension]]',
                'fileUrl' => '@web/files/modifications/origin/[[id]].[[extension]]',
                'thumbPath' => '@webroot/files/modifications/cache/[[profile]]/[[id]].[[extension]]',
                'thumbUrl' => '@web/files/modifications/cache/[[profile]]/[[id]].[[extension]]',
                'thumbs' => [
                    'modification' => ['width' => 50, 'height' => 120],
                    'full' => ['width' => 1000, 'height' => 1000],
                ],
            ],
        ];
    }
}