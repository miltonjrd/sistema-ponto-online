<?php

namespace App\Services;
use App\Contracts\RepositoryContract;

use App\Contracts\ServiceContract;
use App\Contracts\ServiceReadContract;

class ListEmployeeByIdService implements ServiceContract 
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
    public function execute(mixed $id): mixed
    {
        $employees = $this->repository->listByid($id);
        return $employees;
    }
}