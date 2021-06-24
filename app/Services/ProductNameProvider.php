<?php


namespace App\Services;


use Faker\Provider\Base;

class ProductNameProvider extends Base
{
    protected $prefix = [
        'mega',
        'ultra',
        'turbo',
        'uber',
        'big',
        'super',
        'duper',
        'monster',
        'rain',
        'fog',
        'sun',
    ];


    protected $actions = [
        'jumper',
        'cleaner',
        'driver',
        'player',
        'eater',
        'eraser',
        'printer',
        'cutter',
        'painter',
        'cooker',
        'washer',
        'recorder',
        'decoder',
        'walker',
        'shiner',
        'shaver',
        'fryer',
        'slicer',
        'coder',
        'opener',
        'closer',
        'sleeper',
        'waker',
        'payer',
        'singer',
        'vlogger',
        'video',
        'audio',
        'abb',
        'visor',
        'tinker',
    ];

    protected $suffix = [
        '0',
        '1',
        '2',
        '100',
        '200',
        '500',
        '1000',
        '2000',
        '2020',
        '3000',
        '4000',
        'M',
        'L',
        'XL',
        'XXL',
        'X',
        'I',
        'II',
        'III',
        'IV',
        'lite',
        'unlimited',
        'black edition',
        'white edition',
        'gold',
        'silver',
        'bronze',
        'pro',
        'starter',
        'starter pack',
        'beginner',
        'kit',
    ];

    public function productName()
    {

        $prefix = ucfirst(static::randomElement($this->prefix));
        $action = ucfirst(static::randomElement($this->actions));
        $suffix = static::randomElement($this->suffix);

        return "${prefix}${action} ${suffix}";
    }
}
