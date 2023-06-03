<?php

use App\Http\Controllers\BoardController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/users/login', [UserController::class, 'login'])->name('user.login');
Route::post('/users/loginpost', [UserController::class, 'loginpost'])->name('user.loginpost');

Route::get('/boards/list', [BoardController::class, 'list'])->name('board.index');
Route::get('/boards/write', [BoardController::class, 'write'])->name('board.write');
Route::post('/boards/write', [BoardController::class, 'store'])->name('board.store');
// url에 행위를 안 적고 세그먼트, 파라미터로 구분하기