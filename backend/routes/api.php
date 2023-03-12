<?php

use App\Http\Requests\CreateEmployeeRequest;
use App\Http\Requests\CreateRoleRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\RoleController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::controller(AdminController::class)->prefix('/admin')->group(function () {
    Route::middleware(['assign.guard:admins', 'jwt.auth'])->get('/me', 'me');
    Route::middleware(['assign.guard:admins'])->post('/login', 'login');
});

Route::controller(EmployeeController::class)->prefix('/employees')->group(function () {
    Route::get('/', 'listAll');
    Route::get('/clockin', 'listAllCIWithEmployeeData');
    Route::get('/{id}', 'listById');
    
    Route::middleware(['assign.guard:admins'])->post('/', 'create');
    Route::middleware(['assign.guard:employees'])->post('/login', 'login');
    Route::middleware(['assign.guard:employees'])->post('/clockin', 'clockIn');

    Route::middleware(['assign.guard:admins'])->put('/{id}', 'update');

    Route::middleware(['assign.guard:admins'])->delete('/{id}', 'delete');
});

Route::controller(RoleController::class)->prefix('/roles')->group(function () {
    Route::get('/', 'listAll');

    Route::middleware(['assign.guard:admins'])->post('/', 'create');

    Route::middleware(['assign.guard:admins'])->delete('/', 'delete');
});
