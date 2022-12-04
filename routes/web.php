<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LGAController;
use App\Http\Controllers\OfficialController;
use App\Http\Controllers\PollingUnitController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\WardController;
use Illuminate\Support\Facades\Auth;
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

Route::group(["middleware"=>"auth"], function() {

    Route::get('/home', [DashboardController::class, 'dash']); //[App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/dash', [DashboardController::class, 'dash']);

    Route::get('/all', [HomeController::class, 'show_all'])->name("show_all_summary");

    Route::resource('/states', StateController::class);
    Route::resource('/lga', LGAController::class);
    Route::resource('/ward', WardController::class);
    Route::resource('/pu', PollingUnitController::class);


    Route::resource('/officials', OfficialController::class);
    Route::get('/state/officials/{state}', [OfficialController::class, 'officialsByState']);
    Route::get('/lga/officials/{lga}', [OfficialController::class, 'officialsByLGA']);
    Route::get('/ward/officials/{ward}', [OfficialController::class, 'officialsByWard']);
    Route::get('/unit/officials/{unit}', [OfficialController::class, 'officialsByUnit']);

});

Auth::routes([
    "register"=>false
]);
