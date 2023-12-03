<?php

use App\Http\Controllers\api\BillCatController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::apiResource('bill_cat', BillCatController::class); 
Route::get('bill_cat', [BillCatController::class, 'index']); 
Route::get('bill_cat/{id}', [BillCatController::class, 'show']); 
Route::post('bill_cat', [BillCatController::class, 'store']); 
Route::put('bill_cat/{id}', [BillCatController::class, 'update']); 
Route::delete('bill_cat/{id}', [BillCatController::class, 'destroy']); 
