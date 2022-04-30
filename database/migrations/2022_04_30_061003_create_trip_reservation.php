<?php

use App\Constant\Schema as DBSCHEMA;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTripReservation extends Migration
{
    public function up()
    {
        Schema::create(DBSCHEMA::DB_TRIP_RESERVATION, function (Blueprint $table) {
            $table->id();
            $table->integer('trip_id');
            $table->string('passenger_name',20);
            $table->smallInteger('selected_spots')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists(DBSCHEMA::DB_TRIP_RESERVATION);
    }
}
