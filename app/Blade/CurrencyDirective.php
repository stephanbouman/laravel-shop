<?php

namespace App\Blade;


use Illuminate\Support\Facades\Blade;

class CurrencyDirective
{
    public static function boot()
    {
        Blade::directive('currency', function ($value) {
            return "<?php echo \App\Service\Currency::format(${value}); ?>";
        });
    }
}
