<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingSeasonDayTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_season_day', function (Blueprint $table) {
            $table->increments('id');
		    $table->integer('booking_season_id')->unsigned();
            $table->string('type', 100);
            $table->string('day_date', 100);
		    $table->string('quota', 45);
		
		    $table->index('booking_season_id','fk_booking_season_day_booking_season1_idx');
		
		    $table->foreign('booking_season_id')
		        ->references('id')->on('booking_season');
		
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
        Schema::dropIfExists('booking_season_day');
    }
}
