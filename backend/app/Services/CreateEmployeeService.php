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
    public function execute($body) 
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
            'name' => $body->name,
            'password' => Hash::make($body->password),
            'age' => $body->age,
            'role_id' => $body->role_id
        ];

        $this->repository->create($data);
    }
}