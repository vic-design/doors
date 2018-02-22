<?php

namespace app\fond\service\shop;

use Yii;
use app\fond\forms\shop\OrderEditForm;
use app\fond\repositories\shop\OrderRepository;

class OrderManageService
{
    private $orders;

    public function __construct(OrderRepository $orders)
    {
        $this->orders = $orders;
    }

    public function edit($id, OrderEditForm $form): void
    {
        $order = $this->orders->get($id);

        $order->edit(
            $form->customerName,
            $form->customerPhone,
            $form->customerEmail,
            $form->note,
            $form->cancelledReason
        );

        $this->orders->save($order);
    }

    public function completed($id): void
    {
        $order = $this->orders->get($id);
        $order->completed();
        $this->orders->save($order);
        $sent = Yii::$app->mailer->compose('completed', ['order' => $order])
            ->setTo($order->customer_email)
            ->setSubject('Состояние Вашего заказа №'. $order->id .' изменилось')
            ->send();
        if (!$sent){
            throw new \DomainException('Ошибка отправки.');
        }
    }

    public function sent($id): void
    {
        $order = $this->orders->get($id);
        $order->sent();
        $this->orders->save($order);
        $sent = Yii::$app->mailer->compose('sent', ['order' => $order])
            ->setTo($order->customer_email)
            ->setSubject('Состояние Вашего заказа №'. $order->id .' изменилось')
            ->send();
        if (!$sent){
            throw new \DomainException('Ошибка отправки.');
        }
    }

    public function cancelled($id): void
    {
        $order = $this->orders->get($id);
        $order->cancelled();
        $this->orders->save($order);
        $sent = Yii::$app->mailer->compose('cancelled', ['order' => $order])
            ->setTo($order->customer_email)
            ->setSubject('Ваше заказ №'. $order->id .' анулирован')
            ->send();
        if (!$sent){
            throw new \DomainException('Ошибка отправки.');
        }
    }

    public function remove($id): void
    {
        $order = $this->orders->get($id);
        $this->orders->remove($order);
    }
}