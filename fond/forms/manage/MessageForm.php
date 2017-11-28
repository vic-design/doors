<?php

namespace app\fond\forms\manage;


use yii\base\Model;

class MessageForm extends Model
{
    public $name;
    public $phone;
    public $email;
    public $body;
    public $accept = TRUE;

    public function rules() {
        return [
            [['name', 'phone'], 'required'],
            [['name', 'phone', 'email'], 'string', 'max' => 255],
            ['body', 'string'],
            ['email', 'email'],
            ['accept', 'boolean'],
            ['accept', 'compare', 'compareValue' => TRUE, 'message' => 'Необходимо дать согласие на обработку персональных данных.'],
        ];
    }

    public function attributeLabels() {
        return [
            'name' => 'ФИО',
            'phone' => 'Телефон',
            'email' => 'Email',
            'body' => 'Текст сообщения',
            'accept' => 'Согласен на обработку персональных данных',
        ];
    }
}