<?php

namespace app\widgets;


use app\fond\cart\Cart;
use yii\base\Widget;

class CartWidget extends Widget
{
    private $cart;

    public function __construct(Cart $cart, array $config = [])
    {
        parent::__construct($config);
        $this->cart = $cart;
    }

    public function run(): string
    {
        return $this->render('cart', [
            'cart' => $this->cart,
        ]);
    }
}