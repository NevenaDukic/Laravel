<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\PerformanceController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TheatreController;
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


Route::get('performances',[PerformanceController::class,'index']);
Route::get('theatres',[TheatreController::class,'index']);


Route::post('register',[AuthController::class,'register']);
Route::post('login',[AuthController::class,'login']);


Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/profile', function () {
        return auth()->user();
    });

   //sve stavili
    Route::resource('/users', UserController::class)->only(['index', 'update', 'destroy']);

   //sve stavili
    Route::resource('/tickets', TicketController::class)->only(['index','store','destroy']);


   //stavili sve u dokumentaciu
    Route::resource('/performances', PerformanceController::class)->only(['store','update','destroy']);

    //stavili sve u dokumentaciju
    Route::resource('/theatres', TheatreController::class)->only(['store','update','destroy']);

    //stavili
    Route::post('/logout', [AuthController::class, 'logout']);
});