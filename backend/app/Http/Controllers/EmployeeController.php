<?php

namespace App\Http\Controllers;

use App\Exceptions\UnauthorizedResponseException;
use App\Http\Requests\CreateEmployeeRequest;
use App\Http\Requests\EmployeeClockInRequest;
use App\Http\Requests\EmployeeLoginRequest;
use App\Http\Requests\ListEmployeeByIdRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Http\Requests\DeleteEmployeeRequest;

use App\Services\CreateEmployeeService;
use App\Services\DeleteEmployeeService;
use App\Services\EmployeeAuthenticationService;
use App\Services\EmployeeClockInService;
use App\Services\ListAllCIWithEmployeeDataService;
use App\Services\ListAllEmployeesService;
use App\Services\ListEmployeeByIdService;
use App\Services\UpdateEmployeeService;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class EmployeeController extends Controller
{
    public function __construct() { }

    public function create(CreateEmployeeRequest $request, CreateEmployeeService $service) 
    {
        $service->execute($request);

        return response()->json([
            'success' => true,
            'message' => 'Funcionário criado com sucesso.'
        ], 201);
    }

    public function listAll(ListAllEmployeesService $service)
    {
        $results = $service->execute();

        return response()->json($results);
    }

    /**
     * Summary of listById
     * @param ListEmployeeByIdRequest $request
     * @param ListEmployeeByIdService $service
     * @return mixed
     */
    public function listById(ListEmployeeByIdRequest $request, ListEmployeeByIdService $service)
    {
        $result = $service->execute($request->id);
        return $result;
    }

    public function listAllCIWithEmployeeData(Request $request, ListAllCIWithEmployeeDataService $service)
    {
        $results = $service->execute($request);
        return response()->json($results);
    }

    public function update(UpdateEmployeeRequest $request, UpdateEmployeeService $service)
    {
        $service->execute($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Dados do funcionário atualizados com sucesso.'
        ], 200);
    }

    public function delete(DeleteEmployeeRequest $request, DeleteEmployeeService $service)
    {
        $service->execute($request->id);

        return response()->json([
            'success' => true,
            'message' => 'O funcionário foi deletado com sucesso.'
        ], 200);
    }

    public function clockIn(EmployeeClockInRequest $request, EmployeeClockInService $service)
    {
        $service->execute($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Você bateu seu ponto de hoje.'
        ], 200);
    }

    public function login(EmployeeLoginRequest $request, EmployeeAuthenticationService $service)
    {
        try {
            $token = $service->execute($request);
            return response()->json([
                'success' => true,
                'message' => 'Você foi autorizado.',
                'token' => $token
            ]);
        } catch (UnauthorizedResponseException $e) {
            return $e->render();
        }
    }
}
