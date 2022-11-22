<?php

use App\Http\Controllers\LGAController;
use App\Http\Controllers\PollingUnitController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\WardController;
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


Route::get('/state/{id}', [StateController::class, 'show']);
Route::get('/state', [StateController::class, 'index']);

Route::get('/lga/{id}', [LGAController::class, 'show']);
Route::get('/lga', [LGAController::class, 'lga']);

Route::get('/ward/{id}', [WardController::class, 'show']);
Route::get('/ward', [WardController::class, 'index']);

Route::get('/pu/{id}', [PollingUnitController::class, 'show']);
Route::get('/pu', [PollingUnitController::class, 'index']);
