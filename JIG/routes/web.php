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
use App\Models\Ward;

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

Route::get('test', function(){
    // foreach(\App\Models\LGA::all() as $L){
    //     $ids = $L->Wards->pluck('id')->toArray();

    //     $U = \App\Models\User::updateOrCreate([
    //         "name" => $L->name . " Coordinator",
    //         "email" => strtolower( str_replace(" ", "", $L->name) ) . "@gmail.com",
    //     ],[
    //         "password" => bcrypt("password"),
    //         "allowed_wards" => $ids
    //     ]);
        
    // }
    $wids = Ward::whereIn("lga_id", [27])->pluck("id")->toArray();
    UpdateCounts::dispatch($wids);
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dash/accreditation', [DashboardController::class, 'accreditation_dash_1'])->name('accreditation_dash_1');
Route::get('/dash/tally', [DashboardController::class, 'tally_dash'])->name('tally_dash');
Route::get('/dash/spread/{lga_id?}/{ward_id?}/{pu_id?}', [DashboardController::class, 'spread_dash'])->name('spread_dash');


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
    Route::get('/submit/agent/{pu_id}', [PollingUnitController::class, 'submit_agent'])->name("submit_agent");
    Route::post('/submit/agent/{pu_id}', [PollingUnitController::class, 'fn_submit_agent'])->name("submit_agent");
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

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');