<?php

use App\Models\LGA;
use App\Models\PollingUnit;
use App\Models\State;
use App\Models\Ward;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVotingResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('voting_results', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(State::class);
            $table->foreignIdFor(LGA::class, "lga_id");
            $table->foreignIdFor(Ward::class);
            $table->foreignIdFor(PollingUnit::class);
            $table->integer("count");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('voting_results');
    }
}
