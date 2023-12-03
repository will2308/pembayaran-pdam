<?php

use App\Http\Controllers\BillCatController;
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
Route::put('kategori/{id}', [BillCatController::class, 'update']);
Route::delete('kategori/{id}', [BillCatController::class, 'destroy']);