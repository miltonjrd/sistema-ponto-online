<?php

namespace App\Services;

use App\Contracts\ServiceContract;
use App\Contracts\ClockedInRepositoryContract;
use Illuminate\Support\Facades\Request;

class EmployeeClockInService implements ServiceContract
{
    /**
     * @var ClockedInRepositoryContract
     */
    private $repository;

    public function __construct(ClockedInRepositoryContract $repository)
    {
        $this->repository = $repository;
    }
	/**
	 * @param Request $request
	 */
	public function execute(Request $request) 
    {
        $data = [
            'employee_id' => $request->employee_id
        ];

        $this->repository->create($data);
	}
}