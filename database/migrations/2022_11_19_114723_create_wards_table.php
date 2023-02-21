<?php

use App\Models\LGA;
use App\Models\State;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wards', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->foreignId('lga_id');
            $table->foreignIdFor(State::class);
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
        Schema::dropIfExists('wards');
    }
}
