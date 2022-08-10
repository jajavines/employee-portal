<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\EmployeesController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Employee CRUD
Route::post('/employee', [EmployeesController::class, 'create']);
Route::get('/employee/{employee}', [EmployeesController::class, 'read']);
Route::patch('/employee/{employee}', [EmployeesController::class, 'update']);
Route::delete('/employee/{employee}', [EmployeesController::class, 'delete']);