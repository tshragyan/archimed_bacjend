<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('get-task/{id}', [TaskController::class, 'get'])->middleware('auth:sanctum');
Route::put('update-task/{id}', [TaskController::class, 'update'])->middleware('auth:sanctum');
Route::get('get-tasks', [TaskController::class, 'index']);
Route::post('create-task', [TaskController::class, 'create']);
Route::post('login', [AuthController::class, 'login']);
