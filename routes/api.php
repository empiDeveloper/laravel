<?php

use App\Http\Controllers\Others\GeneralController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Publications\PostsController;

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

Route::controller(UserController::class)->prefix("users")->group(function(){
    Route::get('listar', 'getUsers')->name('users.listar');
});

Route::controller(PostsController::class)->prefix("publicaciones")->group(function(){
    Route::get('listar', 'getPublications')->name('publicaciones.listar');
});



Route::controller(GeneralController::class)->prefix("general")->group(function(){
    Route::get('statistics', 'getGeneralStatistics')->name('general.statistics');
});


