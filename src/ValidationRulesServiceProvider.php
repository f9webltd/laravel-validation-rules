<?php

namespace F9Web\ValidationRules;

use Illuminate\Support\ServiceProvider;
use function resource_path;

class ValidationRulesServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang/', 'f9web-validation-rules');

        $this->publishes(
            [
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/f9web-validation-rules'),
            ]
        );
    }
}
