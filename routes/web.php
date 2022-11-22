<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LGAController;
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

Route::get('/try', function () {
    return view('home1');
});

Route::get('/dash', [DashboardController::class, 'dash']);
Route::get('/state', [StateController::class, 'index']);
Route::get('/lga', [LGAController::class, 'lga']);
Route::get('/lga/{id}', [LGAController::class, 'showLGAByState']);
Route::get('/ward', [WardController::class, 'index']);
Route::get('/ward/{id}', [WardController::class, 'wardByLGA']);
Route::get('/unit', [PollingUnitController::class, 'index']);
Route::get('/unit/{id}', [PollingUnitController::class, 'showPollingUnitByLGI']);


Auth::routes();

Route::get('/home',[DashboardController::class, 'dash']); //[App\Http\Controllers\HomeController::class, 'index'])->name('home');
