<?php

namespace App\Services;
use App\Contracts\ServiceContract;
use App\Contracts\RepositoryContract;

class EmployeeAuthenticationService implements ServiceContract
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
	 */
    public function execute(mixed $data) 
    {
        $credentials = [
            'id' => $data->code,
            'password' => $data->password
        ];

        $token = auth()->attempt($credentials);

        if (!$token) 
        {

        }
	}
}