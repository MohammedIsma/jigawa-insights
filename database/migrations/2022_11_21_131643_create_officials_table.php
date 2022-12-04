<?php

use App\Models\LGA;
use App\Models\OfficialType;
use App\Models\PollingUnit;
use App\Models\State;
use App\Models\Ward;
use App\Models\Zone;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfficialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('officials', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(OfficialType::class);
            $table->foreignIdFor(State::class)->nullable();
            $table->foreignIdFor(Zone::class);
            $table->foreignId('lga_id');
            $table->foreignIdFor(Ward::class)->nullable();
            $table->foreignIdFor(PollingUnit::class)->nullable();
            $table->string('name');
            $table->string('phone_number');
            $table->string('designation');
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
        Schema::dropIfExists('officials');
    }
}
