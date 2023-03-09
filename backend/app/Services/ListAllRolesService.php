<?php

namespace App\Services;

use App\Contracts\RepositoryContract;
use App\Contracts\ServiceReadContract;

class ListAllRolesService implements ServiceReadContract
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
	 * @param mixed $data
	 * @return mixed
	 */
	public function execute(): mixed 
    {
        $roles = $this->repository->listAll();
        return $roles;
	}
}