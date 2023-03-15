<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LGAController;
use App\Http\Controllers\OfficialController;
use App\Http\Controllers\PollingUnitController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\WardController;
use App\Jobs\FetchPUSlips;
use App\Jobs\UpdateCounts;
use App\Models\VotingResult;
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

Route::get('pull-slips', function() {
    set_time_limit(0);
    $PUs = \App\Models\PollingUnit::whereNull('has_image')->take(100)->get();
    $PS = FetchPUSlips::dispatchSync($PUs);
});
Route::get('test', function(){
    $iids = [12,23];
    $PUs = \App\Models\PollingUnit::whereIn('lga_id', $iids)->get();

    foreach($PUs as $pu){

        $VR = VotingResult::selectRaw("political_party_id,SUM(count) as tally")
            ->where("polling_unit_id", $pu->id)
            ->having("tally",">",0)
            ->groupBy("political_party_id")
            ->get();

        $voted = $VR->sum('tally');

        echo sprintf("%s!%s!%s!%s!%s!%s",
            $pu->LGA->name,
            $pu->Ward->name,
            $pu->name,
            $pu->voter_count,
            $voted,
            round($voted/$pu->voter_count,2)
                );
        echo "<br />";
    }

    exit;
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
//    $wids = Ward::whereIn("lga_id", [1])->pluck("id")->toArray();
//    UpdateCounts::dispatch($wids);

    $with_results = \App\Models\VotingResult::pluck("polling_unit_id")->toArray();
    foreach(\App\Models\PollingUnit::orderBy("lga_id")->orderBy("ward_id")->get() as $pu){
        if(!in_array($pu->id, $with_results)) {
            echo sprintf("%s|%s|%s<br />",
                $pu->LGA->name,
                $pu->Ward->name,
                $pu->name,
            );
        }
    }
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

    Route::get('/clear_results/{pu}', [PollingUnitController::class, 'delete_results'])->name("delete_results");
    Route::post('/find_pu', [PollingUnitController::class, 'search'])->name("find_pu");

});

Auth::routes([
    "register"=>false
]);

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
