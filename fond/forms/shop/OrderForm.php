<?php

namespace app\fond\forms\shop;


use yii\base\Model;

class OrderForm extends Model
{
    public $customerName;
    public $customerPhone;
    public $customerEmail;
    public $note;

    public function __construct($price,  array $config = [])
    {
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [['customerName', 'customerPhone', 'customerEmail'], 'required'],
            [['customerName', 'customerPhone', 'customerEmail'], 'string', 'max' => 255],
            ['customerEmail', 'email'],
            ['note', 'string'],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'customer_name' => 'ФИО покупателя',
            'customerName' => 'ФИО покупателя',
            'customer_phone' => 'Телефон покупателя',
            'customerPhone' => 'Телефон покупателя',
            'customer_email' => 'Email покупателя',
            'customerEmail' => 'Email покупателя',
            'note' => 'Комментарий к заказу',
        ];
    }
}