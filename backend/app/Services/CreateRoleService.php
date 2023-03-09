<?php

namespace App\Services;
use App\Contracts\ServiceContract;
use App\Contracts\RepositoryContract;

use Illuminate\Support\Facades\Request;

class CreateRoleService implements ServiceContract
{
    /**
     * @var RepositoryContract
     */
    private $repository;

    public function __construct(RepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function execute(Request $request)
    {
        $request->validate([
            'title' => 'required|string'
        ], [
            'required' => 'O campo :attribute é obrigatório.',
            'string' => 'O campo :attribute deve ser uma string.'
        ]);

        $data = [
            'title' => $request->title
        ];

        $this->repository->create($data);
    }
}