<?php

use App\Constant\Schema as DBSCHEMA;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrips extends Migration
{
    public function up()
    {
        Schema::create(DBSCHEMA::DB_TRIPS, function (Blueprint $table) {
            $table->id();
            $table->string('origin')->nullable(true);
            $table->string('destination')->nullable(true);
            $table->integer('total_spots')->default(10);
            $table->dateTime('start_time')->comment('the time that users can start reserving');
            $table->dateTime('end_time')->comment('the time that users could not change trip');
            $table->integer('cancel_time')->comment('the time in minutes that user can cancel or modify before end time ');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists(DBSCHEMA::DB_TRIPS);
    }
}
