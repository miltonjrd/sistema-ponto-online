<?php

namespace App\Services;
use App\Contracts\ServiceContract;
use App\Contracts\RepositoryContract;

use App\Http\Requests\CreateRoleRequest;

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

    public function execute(mixed $body): mixed
    {
        $data = [
            'title' => $body->title
        ];

        $this->repository->create($data);

        return true;
    }
}