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

Route::group(['middleware'=>'auth:sanctum'], function() {

    Route::get('/logout',             [RegisterController::class,'logout']);

    Route::post('/orders',            [OrderController::class,'store']);
    
    Route::group(['middleware'=>'is_chief'], function() {
        Route::get('/orders/myitems',            [OrderController::class,'myitems']);
    });
    
    Route::group(['middleware'=>'is_captain'], function() {
        Route::get('/orders/{order}', [OrderController::class,'show']);
    });
    
});


Route::post('/register',          [RegisterController::class,'register']);
Route::post('/login',             [RegisterController::class,'login']);
