<?php

namespace App\Providers;

use App\Services\CreateEmployeeService;
use App\Services\ListAllEmployeesService;

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
        $this->app->when(ListAllEmployeesService::class)
        ->needs(RepositoryContract::class)
        ->give(function() {
            return new EmployeeRepository();
        });

        $this->app->when(CreateEmployeeService::class)
        ->needs(RepositoryContract::class)
        ->give(function() {
            return new EmployeeRepository();
        });
        
        $this->app->when(DeleteEmployeeService::class)
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
