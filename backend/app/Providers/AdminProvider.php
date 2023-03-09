<?php

namespace App\Providers;

use App\Contracts\RepositoryContract;
use App\Repositories\EmployeeRepository;
use App\Services\AdminAuthenticationService;
use Illuminate\Support\ServiceProvider;

class AdminProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->when(AdminAuthenticationService::class)
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
