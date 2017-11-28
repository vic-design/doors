<?php

namespace app\fond\forms\manage;


use yii\base\Model;

class CallForm extends Model
{
    public $name;
    public $phone;
    public $accept = TRUE;

    public function rules() {
        return [
            [['name', 'phone'], 'required'],
            [['name', 'phone'], 'string', 'max' => 255],
            ['accept', 'boolean'],
            ['accept', 'compare', 'compareValue' => TRUE, 'message' => 'Необходимо согласие на обработку персональных данных.'],
        ];
    }

    public function attributeLabels() {
        return [
            'name' => 'ФИО',
            'phone' => 'Телефон',
            'accept' => 'Согласен на обработку персональных данных',
        ];
    }
}