<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_list', function (Blueprint $table) {
            $table->increments('id');
		    $table->integer('users_id')->unsigned();
		    $table->unsignedInteger('booking_season_day_id')->nullable();
		    $table->unsignedInteger('booking_season_day_booking_season_id')->nullable();
		    $table->integer('items_total');
		    $table->decimal('list_total', 30, 2);
		    $table->integer('commision_percentage');
		    $table->decimal('order_commision', 30, 2);
		    $table->decimal('order_total', 30, 2);
		
		    $table->index('users_id','fk_order_list_users1_idx');
		    $table->index(['booking_season_day_id', 'booking_season_day_booking_season_id'],'fk_order_list_booking_season_day1_idx');
		
		    $table->foreign('users_id')
		        ->references('id')->on('users');
		
		    $table->foreign('booking_season_day_id')
		        ->references('id')->on('booking_season_day');
		
		    $table->foreign('booking_season_day_booking_season_id')
		        ->references('booking_season_id')->on('booking_season_day');
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
        Schema::dropIfExists('order_list');
    }
}
