<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderListHasUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_list_has_users', function (Blueprint $table) {
            $table->integer('order_list_id')->unsigned();
		    $table->integer('users_id')->unsigned();
		    $table->string('status', 100);
		    $table->string('attachment', 200)->nullable();
		    
		    $table->primary('order_list_id', 'users_id');
		
		    $table->index('users_id','fk_order_list_has_users_users1_idx');
		    $table->index('order_list_id','fk_order_list_has_users_order_list_idx');
		
		    $table->foreign('order_list_id')
		        ->references('id')->on('order_list');
		
		    $table->foreign('users_id')
		        ->references('id')->on('users');
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
        Schema::dropIfExists('order_list_has_users');
    }
}
