<?php

namespace App\Services;

use App\Contracts\ServiceContract;
use App\Contracts\ClockedInRepositoryContract;
use App\Http\Requests\EmployeeClockInRequest;
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
    
	public function execute(EmployeeClockInRequest $request) 
    {
        $data = [
            'employee_id' => auth()->user()->id
        ];

        $this->repository->create($data);
	}
}