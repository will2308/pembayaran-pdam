<?php

use App\Http\Controllers\BillCatController;
use App\Http\Controllers\DashboarController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('kategori', [BillCatController::class, 'index']);
Route::post('kategori', [BillCatController::class, 'store']);
Route::get('kategori/{id}', [BillCatController::class, 'edit']);
Route::delete('kategori/{id}', [BillCatController::class, 'destroy']);
Route::post('kategori/keyword', [BillCatController::class, 'search']);

// Route::resource('user', UserController::class);
Route::get('user', [UserController::class, 'index']);
Route::post('user', [UserController::class, 'store']);
Route::put('user/{id}', [UserController::class, 'edit']);
Route::delete('user/{id}', [UserController::class, 'destroy']);

Route::get('login', [DashboarController::class, 'login']);
Route::post('dologin', [DashboarController::class, 'dologin'])->name('dologin');
Route::get('logout', [DashboarController::class, 'logout'])->name('logout');
