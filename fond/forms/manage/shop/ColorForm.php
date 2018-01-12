<?php

namespace app\fond\forms\manage\shop;


use app\fond\entities\manage\shop\Color;
use yii\base\Model;
use yii\web\UploadedFile;

class ColorForm extends Model
{
    public $name;
    public $image;

    private $_color;

    public function __construct(Color $color = null, array $config = [])
    {
        if ($color){
            $this->name = $color->name;
            $this->_color = $color;
        }
        parent::__construct($config);
    }

    public function rules()
    {
        return [
            ['name', 'required'],
            ['name', 'string', 'max' => 255],
            ['image', 'image'],
            ['name', 'unique', 'targetClass' => Color::class, 'filter' => $this->_color ? ['<>', 'id', $this->_color->id] : null],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Название',
            'image' => 'Изображение',
        ];
    }

    public function beforeValidate()
    {
        if (parent::beforeValidate()){
            $this->image = UploadedFile::getInstance($this, 'image');
            return true;
        }
        return false;
    }
}