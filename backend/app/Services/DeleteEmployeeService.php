<?php

namespace App\Services;
use App\Contracts\ServiceContract;
use App\Contracts\RepositoryContract;
use Illuminate\Support\Facades\Request;

class DeleteEmployeeService implements ServiceContract
{
    /**
     * @var RepositoryContract;
     */
    private $repository;

    public function __construct(RepositoryContract $repository) 
    {
        $this->repository = $repository;
    }

    public function execute(mixed $id): mixed
    {
        $this->repository->delete($id);

        return true;
    }
}