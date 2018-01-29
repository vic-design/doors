<?php

namespace app\fond\cart\cost\calculator;


use app\fond\cart\CartItem;
use app\fond\cart\cost\Cost;

interface CalculatorInterface
{
    /**
     * @param CartItem[] $items
     * @return Cost
     */
    public function getCost(array $items): Cost;
}