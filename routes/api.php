<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Others\GeneralController;
use App\Http\Controllers\Sellers\SellerController;
use App\Http\Controllers\Statistics\CardsController;
use App\Http\Controllers\Publications\PostsController;
use App\Http\Controllers\Statistics\GraphicsController;

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

Route::controller(GeneralController::class)->prefix("general")->group(function(){
    Route::get('statistics', 'getGeneralStatistics')->name('general.statistics');
});

Route::controller(SellerController::class)->prefix("sellers")->group(function(){
    Route::get('/', 'getSellers')->name('sellers.list');
});

Route::controller(CardsController::class)->prefix("cards")->group(function(){
    Route::get('/', 'getDataCards')->name('cards.list');
});

Route::controller(GraphicsController::class)->prefix("graphics")->group(function(){
    Route::get('/last-years', 'getGraphicsLastYears')->name('graphics.last-years');
    Route::get('/catalog', 'getGraphicCatalog')->name('graphics.catalog');
    Route::get('/stores', 'getGraphicStores')->name('graphics.stores');
});
