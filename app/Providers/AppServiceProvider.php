<?php

namespace App\Providers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('not_equal_to', function ($attribute, $value, $parameters, $validator) {
            return $value !== '#';
        });

        // Custom message dinamis berdasarkan field
        Validator::replacer('not_equal_to', function ($message, $attribute) {
            return "The {$attribute} field is invalid";
        });
    }
}
