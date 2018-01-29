<?php
/**
 * Created by PhpStorm.
 * User: abutan
 * Date: 27.01.18
 * Time: 18:10
 */

namespace app\fond\cart\cost;


final class Discount
{
    private $value;
    private $name;

    public function __construct(float $value, string $name)
    {
        $this->value = $value;
        $this->name = $name;
    }

    public function getValue(): float
    {
        return $this->value;
    }

    public function getName(): string
    {
        return $this->name;
    }
}