<?php

namespace app\fond\service\shop;


use app\fond\cart\Cart;
use app\fond\cart\CartItem;
use app\fond\repositories\shop\ProductRepository;

class CartService
{
    private $products;
    private $cart;

    public function __construct(Cart $cart, ProductRepository $products)
    {
        $this->products = $products;
        $this->cart = $cart;
    }

    public function getCart(): Cart
    {
        return $this->cart;
    }

    public function add($productId, $modificationId, $quantity): void
    {
        $product = $this->products->get($productId);
        $modId = $modificationId ? $product->getModification($modificationId)->id : null;
        $this->cart->add(new CartItem($product, $modId, $quantity));
    }

    public function set($id, $quantity): void
    {
        $this->cart->set($id, $quantity);
    }

    public function remove($id): void
    {
        $this->cart->remove($id);
    }

    public function clear(): void
    {
        $this->cart->clear();
    }
}