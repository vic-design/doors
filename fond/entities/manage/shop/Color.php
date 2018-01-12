<?php

namespace app\fond\entities\manage\shop;


use yii\db\ActiveRecord;
use yii\web\UploadedFile;
use yiidreamteam\upload\ImageUploadBehavior;

/**
 * @property int $id [int(11)]
 * @property string $name [varchar(255)]
 * @property string $image [varchar(255)]
 */
class Color extends ActiveRecord
{
    public static function create($name): self
    {
        $color = new static();
        $color->name = $name;

        return $color;
    }

    public function setPhoto(UploadedFile $image)
    {
        $this->image = $image;
    }

    public function edit($name)
    {
        $this->name = $name;
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Название',
            'image' => 'Изображение',
        ];
    }

    public static function tableName()
    {
        return '{{%product_colors}}';
    }

    public function behaviors()
    {
        return [
            [
                'class' => ImageUploadBehavior::className(),
                'attribute' => 'image',
                'createThumbsOnRequest' => true,
                'filePath' => '@webroot/files/color/origin/[[id]].[[extension]]',
                'fileUrl' => '@web/files/color/origin/[[id]].[[extension]]',
                'thumbPath' => '@webroot/files/color/cache/[[id]].[[extension]]',
                'thumbUrl' => '@web/files/color/cache/[[id]].[[extension]]',
                'thumbs' => [
                    'admin' => ['width' => 20, 'height' => 20],
                ],
            ],
        ];
    }
}