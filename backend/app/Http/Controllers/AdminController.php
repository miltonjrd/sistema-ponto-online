<?php

namespace App\Http\Controllers;

use App\Exceptions\UnauthorizedResponseException;
use App\Http\Requests\AdminLoginRequest;
use App\Models\Admin;
use App\Http\Controllers\Controller;
use App\Services\AdminAuthenticationService;

class AdminController extends Controller
{
    public function login(AdminLoginRequest $request, AdminAuthenticationService $service)
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
