<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LGAController;
use App\Http\Controllers\OfficialController;
use App\Http\Controllers\PollingUnitController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\WardController;
use App\Jobs\UpdateCounts;
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
Route::get('/test', function () {
    UpdateCounts::dispatch();
});

Route::group(["middleware"=>"auth"], function() {

    Route::get('/home', [DashboardController::class, 'dash']); //[App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/dash', [DashboardController::class, 'dash']);

    Route::get('/all', [HomeController::class, 'show_all'])->name("show_all_summary");

    Route::get('/dash/accreditation', [DashboardController::class, 'accreditation_dash_1'])->name('accreditation_dash_1');
//    Route::get('/exec_dash', [DashboardController::class, 'exec_dash'])->name('exec_dash');

    Route::resource('/states', StateController::class);
    Route::resource('/lga', LGAController::class);
    Route::resource('/ward', WardController::class);
    Route::resource('/pu', PollingUnitController::class);

    Route::get('/submit/accreditation/{pu_id}', [PollingUnitController::class, 'submit_accreditation'])->name("submit_accreditation");
    Route::post('/submit/accreditation/{pu_id}', [PollingUnitController::class, 'fn_submit_accreditation'])->name("submit_accreditation");
    Route::post('/submit/results/{pu_id}', [PollingUnitController::class, 'fn_submit_results'])->name("submit_results");

    Route::resource('/officials', OfficialController::class);
    Route::get('/state/officials/{state}', [OfficialController::class, 'officialsByState']);
    Route::get('/lga/officials/{lga}', [OfficialController::class, 'officialsByLGA']);
    Route::get('/ward/officials/{ward}', [OfficialController::class, 'officialsByWard']);
    Route::get('/unit/officials/{unit}', [OfficialController::class, 'officialsByUnit']);

});

Auth::routes([
    "register"=>false
]);
