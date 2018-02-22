<?php

namespace app\fond\order;


use lhs\Yii2SaveRelationsBehavior\SaveRelationsBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * @property int $id [int(11)]
 * @property string $customer_name [varchar(255)]
 * @property string $customer_phone [varchar(255)]
 * @property string $customer_email [varchar(255)]
 * @property int $cost [int(11)]
 * @property string $note
 * @property string $cancelled_reason
 * @property int $status [smallint(6)]
 * @property int $created_at [int(11)]
 *
 * @property OrderItem[] $items
 */
class Order extends ActiveRecord
{
    const NEW = 1;
    const COMPLETED = 2;
    const SENT = 3;
    const CANCELLED = 4;

    public static function create($customerName, $customerPhone, $customerEmail, array $items, $cost, $note): self
    {
        $order = new static();
        $order->customer_name = $customerName;
        $order->customer_phone = $customerPhone;
        $order->customer_email = $customerEmail;
        $order->items = $items;
        $order->cost = $cost;
        $order->note = $note;
        $order->status = self::NEW;
        $order->created_at = time();

        return $order;
    }

    public function edit($customerName, $customerPhone, $customerEmail, $note, $cancelledReason): void
    {
        $this->customer_name = $customerName;
        $this->customer_phone = $customerPhone;
        $this->customer_email = $customerEmail;
        $this->note = $note;
        $this->cancelled_reason = $cancelledReason;
    }

    ############

    public function isNew(): bool
    {
        return $this->status == self::NEW;
    }

    public function isCompleted(): bool
    {
        return $this->status == self::COMPLETED;
    }

    public function isSent(): bool
    {
        return $this->status == self::SENT;
    }

    public function isCancelled(): bool
    {
        return $this->status == self::CANCELLED;
    }

    public function completed(): void
    {
        if ($this->isCompleted()){
            throw new \DomainException('Заказ уже укомплектован.');
        }
        $this->status = self::COMPLETED;
    }

    public function sent(): void
    {
        if ($this->isSent()){
            throw new \DomainException('Заказ уже отправлен.');
        }
        $this->status = self::SENT;
    }

    public function cancelled(): void
    {
        if ($this->isCancelled()){
            throw new \DomainException('Заказ уже анулирован.');
        }
        $this->status = self::CANCELLED;
    }

    ############

    public function getItems(): ActiveQuery
    {
        return $this->hasMany(OrderItem::className(), ['order_id' => 'id']);
    }

    public function behaviors()
    {
        return [
            [
                'class' => SaveRelationsBehavior::className(),
                'relations' => ['items'],
            ],
        ];
    }

    public function transactions()
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }

    ############

    public static function tableName()
    {
        return '{{%shop_orders}}';
    }

    public function attributeLabels(): array
    {
        return [
            'customer_name' => 'ФИО покупателя',
            'customer_phone' => 'Телефон покупателя',
            'customer_email' => 'Email покупателя',
            'status' => 'Состояние заказа',
            'note' => 'Комментарий к заказу',
            'created_at' => 'Время заказа',
            'cost' => 'Полная стоимость заказа, руб',
            'cancelled_reason' => 'Причина ануляции',
            'cancelledReason' => 'Причина ануляции',
        ];
    }
}