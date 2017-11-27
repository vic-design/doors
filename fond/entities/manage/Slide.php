<?php

namespace app\fond\entities\manage;


use yii\db\ActiveRecord;
use yii\web\UploadedFile;
use yiidreamteam\upload\ImageUploadBehavior;

/**
 * @property string $file
 * @property int $id [int(11)]
 * @property int $slider_id [int(11)]
 * @property int $sort [int(11)]
 */
class Slide extends ActiveRecord
{
    public static function create(UploadedFile $file): self
    {
        $slide = new static();
        $slide->file = $file;

        return $slide;
    }

    public function setSort($sort)
    {
        $this->sort = $sort;
    }

    public function isEqualTo($id)
    {
        return $this->id == $id;
    }

    public function attributeLabels() {
        return [
            'file' => 'Слайды',
        ];
    }

    public static function tableName() {
        return '{{%slider_photos}}';
    }

    public function behaviors() {
        return [
            [
                'class' => ImageUploadBehavior::className(),
                'attribute' => 'file',
                'createThumbsOnRequest' => TRUE,
                'filePath' => '@webroot/files/sliders/origin/[[attribute_slider_id]]/[[id]].[[extension]]',
                'fileUrl' => '@web/files/sliders/origin/[[attribute_slider_id]]/[[id]].[[extension]]',
                'thumbPath' => '@webroot/files/sliders/cache/[[attribute_slider_id]]/[[profile]]/[[id]].[[extension]]',
                'thumbUrl' => '@web/files/sliders/cache/[[attribute_slider_id]]/[[profile]]/[[id]].[[extension]]',
                'thumbs' => [
                    'main' => ['width' => 330, 'height' => 100],
                    'front' => ['width' => 850, 'height' => 260],
                ],
            ],
        ];
    }
}