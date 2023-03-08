<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;

use App\Contracts\RepositoryContract;
use App\Contracts\ServiceContract;
use App\Http\Controllers\Controller;

use App\Services\CreateCustomerService;

class CustomerController extends Controller
{
    public function __construct() { }

    public function create(Request $req, CreateCustomerService $service) 
    {
        $service->execute($req);
    }
}
