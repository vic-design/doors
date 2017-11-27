<?php

namespace app\fond\forms\manage;


use elisdn\compositeForm\CompositeForm;

/**
 * @property \app\fond\forms\manage\SlideForm slides
 */
class SliderCreateForm extends CompositeForm
{
    public $name;

    public function __construct(array $config = []) {
        $this->slides = new SlideForm();
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

    public function internalForms() {
        return [
            'slides',
        ];
    }
}