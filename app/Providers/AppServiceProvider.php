<?php

namespace App\Providers;

use App\Models\Plan;
use App\Policies\PlanPolicy;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }

    protected $policies = [
        Post::class => PostPolicy::class,
    ];
    
}
