<?php

namespace App\Providers;

use App\Contracts\RepositoryContract;
use App\Repositories\RoleRepository;
use App\Services\CreateRoleService;
use App\Services\DeleteRoleService;
use App\Services\ListAllRolesService;
use Illuminate\Support\ServiceProvider;

class RoleProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->when(ListAllRolesService::class)
        ->needs(RepositoryContract::class)
        ->give(function () {
            return new RoleRepository();
        });

        $this->app->when(CreateRoleService::class)
        ->needs(RepositoryContract::class)
        ->give(function () {
            return new RoleRepository();
        });

        $this->app->when(DeleteRoleService::class)
        ->needs(RepositoryContract::class)
        ->give(function () {
            return new RoleRepository();
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
