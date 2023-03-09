<?php

namespace App\Services;

use App\Contracts\ServiceContract;
use App\Contracts\RepositoryContract;
use Illuminate\Support\Facades\Request;

use App\Exceptions\UnauthorizedResponseException;

class AdminAuthenticationService implements ServiceContract
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
	 * @param Request $request
	 */
	public function execute($body) 
    {
        $credentials = [
            "id" => $body->code,
            "password" => $body->password
        ];

        $token = auth()->attempt($credentials);

        if (!$token) {
            return throw new UnauthorizedResponseException();
        }

        return $token;
	}
}