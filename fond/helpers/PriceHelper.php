<?php

namespace app\fond\helpers;


class PriceHelper
{
    public static function format($price): string
    {
        return number_format($price, '.', '');
    }
}