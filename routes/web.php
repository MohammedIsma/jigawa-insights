<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LGAController;
use App\Http\Controllers\OfficialController;
use App\Http\Controllers\PollingUnitController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\WardController;
use App\Jobs\FetchPUSlips;
use App\Models\PollingUnit;
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

Route::get('pull-slips', function() {
    set_time_limit(0);
    $PUs = PollingUnit::whereNull('has_image')->take(100)->get();
    $PS = FetchPUSlips::dispatchSync($PUs);
});

Route::get('test', [TestController::class, 'test']);

Route::get('/', function () {
    return redirect('/home');
});

Route::group(["prefix" => "dash-"], function() {
    Route::get('/', [DashboardController::class, 'landing'])->name('dash_landing');
    Route::get('/accreditation', [DashboardController::class, 'accreditation_dash_1'])->name('accreditation_dash_1');
    Route::get('/tally', [DashboardController::class, 'tally_dash'])->name('tally_dash');
    Route::get('/scoreboard', [DashboardController::class, 'scoreboard_dash'])->name('scoreboard_dash');
    Route::get('/prob', [DashboardController::class, 'problem_dash'])->name('problem_dash');
    Route::get('/spread/{lga_id?}/{ward_id?}/{pu_id?}', [DashboardController::class, 'spread_dash'])->name('spread_dash');
});

Route::group(["middleware"=>"auth"], function() {

    Route::get('/home', [DashboardController::class, 'dash']); //[App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/dash', [DashboardController::class, 'dash']);

    Route::get('/all', [HomeController::class, 'show_all'])->name("show_all_summary");


//    Route::get('/exec_dash', [DashboardController::class, 'exec_dash'])->name('exec_dash');

    Route::resource('/states', StateController::class);
    Route::resource('/lga', LGAController::class);
    Route::resource('/ward', WardController::class);
    Route::resource('/pu', PollingUnitController::class);

    Route::get('/submit/accreditation/{pu_id}', [PollingUnitController::class, 'submit_accreditation'])->name("submit_accreditation");
    Route::post('/submit/accreditation/{pu_id}', [PollingUnitController::class, 'fn_submit_accreditation'])->name("submit_accreditation");
    Route::post('/submit/ward_results/{pu_id}', [PollingUnitController::class, 'fn_submit_ward_results'])->name("submit_ward_results");
    Route::get('/submit/agent/{pu_id}', [PollingUnitController::class, 'submit_agent'])->name("submit_agent");
    Route::post('/submit/agent/{pu_id}', [PollingUnitController::class, 'fn_submit_agent'])->name("submit_agent");
    Route::post('/submit/results/{pu_id}', [PollingUnitController::class, 'fn_submit_results'])->name("submit_results");
    Route::get('/report_issue/{pu_id}', [PollingUnitController::class, 'report_issue'])->name("report_issue");
    Route::post('/report_issue/{pu_id}', [PollingUnitController::class, 'fn_report_issue'])->name("report_issue");
    Route::get('/view_issues/{pu_id}', [PollingUnitController::class, 'view_issues'])->name("view_issues");

    Route::resource('/officials', OfficialController::class);
    Route::get('/state/officials/{state}', [OfficialController::class, 'officialsByState']);
    Route::get('/lga/officials/{lga}', [OfficialController::class, 'officialsByLGA']);
    Route::get('/ward/officials/{ward}', [OfficialController::class, 'officialsByWard']);
    Route::get('/unit/officials/{unit}', [OfficialController::class, 'officialsByUnit']);

    Route::get('/clear_results/{pu}', [PollingUnitController::class, 'delete_results'])->name("delete_results");
    Route::post('/find_pu', [PollingUnitController::class, 'search'])->name("find_pu");

});

Auth::routes([
    "register"=>false
]);

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
