<?php

namespace App\Services;
use App\Contracts\ServiceContract;
use App\Contracts\RepositoryContract;
use App\Exceptions\UnauthorizedResponseException;

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
     * @return string
	 */
    public function execute(mixed $data): mixed
    {
        $credentials = [
            'id' => $data->code,
            'password' => $data->password
        ];

        $token = auth()->attempt($credentials);

        if (!$token) {
            throw new UnauthorizedResponseException();
        }

        return $token;
	}
}