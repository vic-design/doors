<?php

namespace app\fond\service\shop;

use Yii;
use app\fond\cart\Cart;
use app\fond\cart\CartItem;
use app\fond\forms\shop\OrderForm;
use app\fond\order\Order;
use app\fond\order\OrderItem;
use app\fond\repositories\shop\OrderRepository;
use app\fond\repositories\shop\ProductRepository;
use app\fond\service\TransactionManager;

class OrderService
{
    private $cart;
    private $orders;
    private $products;
    private $transactions;

    public function __construct(Cart $cart, OrderRepository $orders, ProductRepository $products, TransactionManager $transactions)
    {
        $this->cart = $cart;
        $this->orders = $orders;
        $this->products = $products;
        $this->transactions = $transactions;
    }

    public function checkout(OrderForm $form): Order
    {
        $products = [];

        $items = array_map(function (CartItem $item){
           $product = $item->getProduct();
           $products[] = $product;
           return OrderItem::create(
               $product,
               $item->getModificationId(),
               $item->getSize(),
               $item->getPrice(),
               $item->getQuantity()
           );
        }, $this->cart->getItems());

        $order = Order::create(
            $form->customerName,
            $form->customerPhone,
            $form->customerEmail,
            $items,
            $this->cart->getCost()->getTotal(),
            $form->note
        );

        $this->transactions->wrap(function () use ($order, $products){
           $this->orders->save($order);
           foreach ($products as $product){
               $this->products->save($product);
           }
           $this->cart->clear();
        });

        $sent = Yii::$app->mailer->compose('adminOrder', [
            'cart' => $this->cart,
            'order' => $order
        ])
            ->setTo(Yii::$app->params['adminEmail'])
            ->setSubject('Сделан заказ на сайте '.Yii::$app->name)
            ->send();

        if (!$sent){
            throw new \DomainException('Ошибка отправки. Попробуйте повторить позже.');
        }

        $sented = Yii::$app->mailer->compose('customerOrder', [
            'cart' => $this->cart,
            'order' => $order
        ])
            ->setSubject('Вы оформили заказ на сайте '.Yii::$app->name)
            ->setTo($form->customerEmail)
            ->send();

        if (!$sented){
            throw new \DomainException('Ошибка отправки. Попробуйте повторить позже.');
        }

        return $order;
    }
}