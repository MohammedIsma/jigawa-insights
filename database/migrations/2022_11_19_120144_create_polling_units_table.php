<?php

use App\Models\LGA;
use App\Models\State;
use App\Models\Ward;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePollingUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('polling_units', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lga_id');
            $table->foreignIdFor(Ward::class);
            $table->string("name");
            $table->string("number")->nullable();
            $table->bigInteger("gps")->nullable();
            $table->bigInteger("voter_count")->nullable();
            $table->bigInteger("accredited_count_1")->nullable();
            $table->bigInteger("accredited_count_2")->nullable();
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
        Schema::dropIfExists('polling_units');
    }
}
