<?php

namespace App\Services;
use App\Contracts\RepositoryContract;
use App\Contracts\ServiceContract;

use Illuminate\Database\Eloquent\Collection;

class ListAllEmployeesService implements ServiceContract 
{
    /**
     * @var RepositoryContract;
     */
    private $repository;

    public function __construct(RepositoryContract $repository) 
    {
        $this->repository = $repository;
    }

    /**
     * @return Collection;
     */
    public function execute(): Collection
    {
        $employees = $this->repository->listAll();
        return $employees;
    }
}