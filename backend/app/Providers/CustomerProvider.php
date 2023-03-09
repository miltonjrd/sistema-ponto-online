<?php

namespace App\Providers;

use App\Contracts\ServiceContract;
use Illuminate\Support\ServiceProvider;
use App\Contracts\RepositoryContract;
use App\Repositories\EmployeeRepository;

class EmployeeProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->when(ServiceContract::class)
        ->needs(RepositoryContract::class)
        ->give(function() {
            return new EmployeeRepository();
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
