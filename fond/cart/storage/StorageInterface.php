<?php

namespace app\fond\cart\storage;


use app\fond\cart\CartItem;

interface StorageInterface
{
    /* @return CartItem[] */
    public function load(): array;
    /* @param CartItem[] $items */
    public function save(array $items): void;
}