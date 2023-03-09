<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Http\Requests\CreateRoleRequest;
use App\Http\Requests\DeleteRoleRequest;

use App\Services\CreateRoleService;
use App\Services\DeleteRoleService;

class RoleController extends Controller
{
    public function create(CreateRoleRequest $request, CreateRoleService $service)
    {
        $service->execute($request);

        response()->json([
            'success' => true,
            'message' => 'Cargo criado com sucesso.'
        ], 201);
    }

    public function delete(DeleteRoleRequest $request, DeleteRoleService $service)
    {
        $service->execute($request);

        response()->json([
            'success' => true,
            'message' => 'Cargo deletado com sucesso.'
        ], 200);
    }
}
