<?php

use App\Http\Controllers\BaseCode\SanctumRegisteration\RegisterController;
use App\Http\Controllers\OrderController;
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


Route::group(['middleware'=>'auth:sanctum'], function() {

    // +++++++++++++++++++++++++++++++start Registerations api+++++++++++++++++++++++++++++++++++
    Route::group(['prefix' => 'User','controller'=>RegisterController::class], function() {
        Route::get('/logout',                  'logout');
    });
    // +++++++++++++++++++++++++++++++end Registerations api+++++++++++++++++++++++++++++++++++
    
});

Route::post('/orders',          [OrderController::class,'store']);
    
Route::post('/register',          [RegisterController::class,'register']);
Route::post('/login',             [RegisterController::class,'login']);