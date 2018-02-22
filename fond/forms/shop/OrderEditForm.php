<?php

namespace app\fond\forms\shop;


use app\fond\order\Order;
use yii\base\Model;

class OrderEditForm extends Model
{
    public $customerName;
    public $customerPhone;
    public $customerEmail;
    public $note;
    public $cancelledReason;

    public function __construct(Order $order, array $config = [])
    {
        $this->customerName = $order->customer_name;
        $this->customerPhone = $order->customer_phone;
        $this->customerEmail = $order->customer_email;
        $this->note = $order->note;
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [['customerName', 'customerPhone', 'customerEmail'], 'required'],
            [['customerName', 'customerPhone', 'customerEmail'], 'string', 'max' => 255],
            ['customerEmail', 'email'],
            [['note', 'cancelledReason'], 'string'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'customer_name' => 'ФИО покупателя',
            'customer_phone' => 'Телефон покупателя',
            'customer_email' => 'Email покупателя',
            'note' => 'Комментарий к заказу',
            'cancelledReason' => 'Причина ануляции',
        ];
    }
}