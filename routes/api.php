<?php

use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\BillCatController;
use App\Http\Controllers\api\UserController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout']);
Route::get('error', [AuthController::class, 'verify'])->name('verify');

Route::apiResource('bill_cat', BillCatController::class)->middleware('auth:sanctum'); 
Route::get('bill_cat_all', [BillCatController::class, 'all'])->middleware('auth:sanctum'); 
Route::apiResource('user', UserController::class)->middleware('auth:sanctum'); 
Route::get('user_all', [UserController::class, 'all'])->middleware('auth:sanctum'); 

Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout']);
