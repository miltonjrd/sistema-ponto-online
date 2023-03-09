<?php

namespace App\Services;

use App\Contracts\ClockedInRepositoryContract;
use Illuminate\Http\Request;

class ListAllCIWithEmployeeDataService {
    /**
     * @var ClockedInRepositoryContract
     */
    private $repository;

    public function __construct(ClockedInRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function execute(Request $request)
    {
        $request->validate([
            'start_date' => 'sometimes|string',
            'end_date' => 'sometimes|string'
        ]);

        $this->repository->listAllWithEmployeeData($request->start_date, $request->end_date);
    }
}