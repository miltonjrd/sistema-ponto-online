<?php

namespace App\Services;

use App\Http\Requests\CreateEmployeeRequest;
use App\Contracts\RepositoryContract;
use App\Contracts\ServiceContract;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Hash;

class CreateEmployeeService implements ServiceContract 
{
    /**
     * @var RepositoryContract
     */
    private $repository;
    public function __construct(RepositoryContract $repository) 
    {
        $this->repository = $repository;
    }

    /**
     * 
     */
    public function execute(mixed $body): mixed
    {
        $data = [
            'name' => $body->name,
            'password' => Hash::make($body->password),
            'age' => $body->age,
            'role_id' => $body->role_id
        ];

        $this->repository->create($data);

        return true;
    }
}