<?php

namespace App\Services;
use App\Contracts\RepositoryContract;
use App\Contracts\ServiceContract;
use Illuminate\Support\Facades\Request;

class UpdateCustomerService implements ServiceContract
{
    /**
     * @var RepositoryContract;
     */
    private $repository;

    public function __construct(RepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function execute(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
            'name' => 'sometimes|string',
            'age' => 'sometimes|integer',
            'role_id' => 'sometimes|integer',
            'manager_name' => 'prohibited'
        ]);

        $data = [
            'name' => $request->name,
            'age' => $request->age,
            'role_id' => $request->role_id
        ];

        $this->repository->update($request->id, $data);
    }
}