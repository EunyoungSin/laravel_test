<?php

use App\Http\Controllers\ApiUserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Spatie\FlareClient\Api;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/users/{email}', [ApiUserController::class, 'userget']);
Route::post('/users', [ApiUserController::class, 'userpost']);
Route::put('/users/{email}', [ApiUserController::class, 'userput']);
Route::delete('/users/{email}', [ApiUserController::class, 'userdelete']);