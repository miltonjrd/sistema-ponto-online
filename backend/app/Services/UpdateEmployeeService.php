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

    public function execute($body)
    {
        // $request->validate([
        //     'id' => 'required|integer',
        //     'name' => 'sometimes|string',
        //     'age' => 'sometimes|integer',
        //     'role_id' => 'sometimes|integer',
        //     'manager_name' => 'prohibited'
        // ]);

        $data = [
            'name' => $body->name,
            'age' => $body->age,
            'role_id' => $body->role_id
        ];

        $this->repository->update($body->id, $data);
    }
}