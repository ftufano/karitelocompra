<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderListItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_list_item', function (Blueprint $table) {
            $table->increments('id');
		    $table->integer('order_list_id')->unsigned();
		    $table->string('description', 200);
		    $table->integer('quantity');
		    $table->decimal('price', 30, 2);
		    $table->decimal('item_total', 30, 2);
		    $table->string('link', 200)->nullable();
		    $table->string('image', 200)->nullable();
		
		    $table->index('order_list_id','fk_order_list_detail_order_list1_idx');
		
		    $table->foreign('order_list_id')
		        ->references('id')->on('order_list');
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
        Schema::dropIfExists('order_list_item');
    }
}
