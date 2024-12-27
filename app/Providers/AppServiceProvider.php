<?php

namespace App\Providers;

use App\Interfaces\CalculatorInterface;
use App\Math\StructuredCalculator;
use App\Math\SimpleCalculator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
//        $this->app->bind(CalculatorInterface::class, SimpleCalculator::class);
        $this->app->bind(CalculatorInterface::class, StructuredCalculator::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
