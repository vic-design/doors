<?php

namespace app\fond\forms\manage;


use app\fond\entities\manage\Slider;
use yii\base\Model;

class SliderEditForm extends Model
{
    public $name;

    public function __construct(Slider $slider, array $config = []) {
        $this->name = $slider->name;
        parent::__construct($config);
    }

    public function rules() {
        return [
            ['name', 'required'],
            ['name', 'string', 'max' => 255],
        ];
    }

    public function attributeLabels() {
        return [
            'name' => 'Название слайдера',
        ];
    }
}