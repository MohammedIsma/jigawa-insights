<?php

use App\Models\LGA;
use App\Models\PollingUnit;
use App\Models\State;
use App\Models\User;
use App\Models\Ward;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncidentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incidents', function (Blueprint $table) {
            $table->id();
            $table->string("ident")->unique();
            $table->foreignIdFor(State::class);
            $table->foreignIdFor(LGA::class, "lga_id");
            $table->foreignIdFor(Ward::class);
            $table->foreignIdFor(PollingUnit::class);
            $table->foreignIdFor(User::class);
            $table->longText("description");
            $table->datetime('resolved_at')->nullable();
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
        Schema::dropIfExists('incidents');
    }
}
