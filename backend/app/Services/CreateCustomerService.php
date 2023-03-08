<?php

namespace App\Services;

use App\Repositories\CustomerRepository;
use App\Contracts\ServiceContract;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Hash;

class CreateCustomerService implements ServiceContract 
{
    /**
     * @var CustomerRepository;
     */
    private $repository;
    public function __construct(CustomerRepository $repository) 
    {
        $this->repository = $repository;
    }

    /**
     * 
     */
    public function execute(Request $request) 
    {
        $request->validate([
            'name' => 'required|string',
            'password' => 'required|string',
            'age' => 'required|integer',
            'role_id' => 'required|integer'
        ], [
            'required' => 'O campo :attribute é obrigatório.',
            'string' => 'O campo :attribute deve ser uma string.',
            'integer' => 'O campo :attribute deve ser um número inteiro.',
        ]);

        $data = [
            'name' => $request->name,
            'password' => Hash::make($request->password),
            'age' => $request->age,
            'role_id' => $request->role_id
        ];

        $this->repository->create($data);
    }
}