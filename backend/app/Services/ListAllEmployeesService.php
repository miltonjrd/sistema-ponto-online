<?php

namespace App\Services;
use App\Contracts\RepositoryContract;

use App\Contracts\ServiceReadContract;

class ListAllEmployeesService implements ServiceReadContract 
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
     * @return mixed
     */
    public function execute(): mixed
    {
        $employees = $this->repository->listAll();
        return $employees;
    }
}