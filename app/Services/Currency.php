<?php


namespace App\Services;


class Currency
{
    public static function format(float $value): string
    {
        return "&euro; " . number_format($value, 2,',','.');
    }
}
