<?php

use App\Http\Controllers\LGAController;
use App\Http\Controllers\PollingUnitController;
use App\Http\Controllers\ResultsController;
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

Route::get('/ajx_get_tally_results', [ResultsController::class, 'ajx_get_tally_results']);
Route::get('/ajx_get_lgas', [LGAController::class, 'ajx_get_lgas']);
Route::get('/ajx_get_wards/{lga_id}', [LGAController::class, 'ajx_get_wards']);
Route::get('/ajx_get_lga_winners', [LGAController::class, 'ajx_get_lga_winners']);

Route::get('/ajx_get_wardparties_with_tally/{lga_id}', [LGAController::class, 'ajx_get_ward_results_tally']);
Route::get('/ajx_get_lga_pu_results_tally/{ward_id}', [LGAController::class, 'ajx_get_lga_pu_results_tally']);

Route::get('/ajx_get_ward_result_entry/{ward_id}', [WardController::class, 'ajx_get_ward_sheet']);
Route::post('/ajx_submit_ward_result_entry/{ward_id}', [WardController::class, 'ajx_submit_ward_sheet']);
