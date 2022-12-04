<?php

use App\Models\LGA;
use App\Models\State;
use App\Models\Ward;
use App\Models\Zone;
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
            $table->foreignIdFor(Zone::class);
            $table->string("name");
            $table->bigInteger("number")->nullable();
            $table->bigInteger("gps")->nullable();
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
