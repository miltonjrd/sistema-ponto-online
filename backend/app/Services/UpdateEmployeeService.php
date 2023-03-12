<?php

namespace App\Services;
use App\Contracts\RepositoryContract;
use App\Contracts\ServiceContract;
use Illuminate\Support\Facades\Request;

class UpdateEmployeeService implements ServiceContract
{
    /**
     * @var RepositoryContract;
     */
    private $repository;

    public function __construct(RepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function execute(mixed $data): mixed
    {   
        $result = $this->repository->update($data['id'], $data);

        return $result;
    }
}