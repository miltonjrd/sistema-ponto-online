<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateEmployeeRequest;
use App\Services\CreateEmployeeService;
use Illuminate\Support\Facades\Request;

use App\Http\Controllers\Controller;

class CustomerController extends Controller
{
    public function __construct() { }

    public function create(CreateEmployeeRequest $req, CreateEmployeeService $service) 
    {

        $service->execute($req);
    }
}
