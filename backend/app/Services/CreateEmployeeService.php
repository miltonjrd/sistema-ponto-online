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
    public function execute(CreateEmployeeRequest $request) 
    {
        // $request->validate([
        //     'name' => 'required|string',
        //     'password' => 'required|string',
        //     'age' => 'required|integer',
        //     'role_id' => 'required|integer'
        // ], [
        //     'required' => 'O campo :attribute é obrigatório.',
        //     'string' => 'O campo :attribute deve ser uma string.',
        //     'integer' => 'O campo :attribute deve ser um número inteiro.',
        // ]);

        $data = [
            'name' => $request->name,
            'password' => Hash::make($request->password),
            'age' => $request->age,
            'role_id' => $request->role_id
        ];

        $this->repository->create($data);
    }
}