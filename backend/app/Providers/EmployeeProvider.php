<?php

namespace App\Providers;

use App\Contracts\ClockedInRepositoryContract;
use App\Repositories\ClockedInRepository;
use App\Services\CreateEmployeeService;
use App\Services\EmployeeAuthenticationService;
use App\Services\EmployeeClockInService;
use App\Services\ListAllCIWithEmployeeDataService;
use App\Services\ListAllEmployeesService;
use App\Services\DeleteEmployeeService;

use App\Services\ListEmployeeByIdService;
use App\Services\UpdateEmployeeService;
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

        $this->app->when(UpdateEmployeeService::class)
        ->needs(RepositoryContract::class)
        ->give(function() {
            return new EmployeeRepository();
        });

        $this->app->when(EmployeeAuthenticationService::class)
        ->needs(RepositoryContract::class)
        ->give(function() {
            return new EmployeeRepository();
        });

        $this->app->when(ListEmployeeByIdService::class)
        ->needs(RepositoryContract::class)
        ->give(function() {
            return new EmployeeRepository();
        });

        $this->app->when(ListAllCIWithEmployeeDataService::class)
        ->needs(ClockedInRepositoryContract::class)
        ->give(function() {
            return new ClockedInRepository();
        });

        $this->app->when(EmployeeClockInService::class)
        ->needs(ClockedInRepositoryContract::class)
        ->give(function() {
            return new ClockedInRepository();
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
