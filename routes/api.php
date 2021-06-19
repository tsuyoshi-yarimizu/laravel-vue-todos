<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TodoController;
use App\Http\Controllers\Api\UserController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/auth/login', [AuthController::class, 'login'])
    ->name('login');

Route::post('/user', [UserController::class, 'create'])
    ->name('user.create');

Route::get('/todo', [TodoController::class, 'index'])
    ->middleware(['auth:sanctum'])
    ->name('todo.list');
Route::post('/todo', [TodoController::class, 'create'])
    ->name('todo.create');
Route::put('/todo/{id}', [TodoController::class, 'update'])
    ->name('todo.update');
