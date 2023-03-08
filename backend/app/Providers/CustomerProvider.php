<?php

namespace App\Providers;

use App\Contracts\ServiceContract;
use Illuminate\Support\ServiceProvider;
use App\Contracts\RepositoryContract;
use App\Repositories\CustomerRepository;
use App\Http\Controllers\CustomerController;

class CustomerProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->when(ServiceContract::class)
        ->needs(RepositoryContract::class)
        ->give(function() {
            return new CustomerRepository();
        });

        
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
