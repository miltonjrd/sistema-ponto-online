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

    public function execute(Request $request)
    {
        $request->validate([
            'id' => 'required|integer'
        ], [
            'required' => 'O campo :attribute é obrigatório.',
            'integer' => 'O campo :attribute deve ser um número inteiro.'
        ]);

        $this->repository->delete($request->id);
    }
}