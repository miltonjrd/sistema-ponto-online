<?php

namespace App\Services;

use App\Repositories\CustomerRepository;
use App\Contracts\ServiceContract;
use Illuminate\Support\Facades\Hash;

class CreateCustomerService implements ServiceContract {
    /**
     * @var CustomerRepository;
     */
    private $repository;
    public function __construct(CustomerRepository $repository) {
        $this->repository = $repository;
    }

    public function execute($body) {
        $data = [
            'name' => $body['name'],
            'password' => Hash::make($body['password']),
            ''
        ];

        $this->repository->create($data);
    }
}