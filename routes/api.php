<?php

use App\Http\Controllers\Authcontroller;
use App\Http\Controllers\ProductController;
use App\Models\Product;
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


Route::post("register",[Authcontroller::class,"register"]);
Route::post("login",[Authcontroller::class,"login"]);

Route::delete('/delete/{id}', [ProductController::class, 'destroy']);

Route::put('/update/{id}', [ProductController::class, 'update']);
Route::get('/products/{id}', [ProductController::class, 'show']);
Route::post('add', [ProductController::class, 'store']);

Route::group(['middleware' => 'auth:sanctum'],function(){
    Route::post("logout",[Authcontroller::class,"logout"]);
    Route::resource('product',ProductController::class);


});
