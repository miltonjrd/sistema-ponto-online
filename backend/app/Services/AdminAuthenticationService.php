<?php

namespace App\Services;

use App\Contracts\ServiceContract;
use App\Contracts\RepositoryContract;
use Illuminate\Support\Facades\Request;

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
	public function execute(Request $request) 
    {
        $credentials = [
            "id" => $request->code,
            "password" => $request->password
        ];

        $token = auth()->attempt($credentials);

        if (!$token) {
            
        }
	}
}