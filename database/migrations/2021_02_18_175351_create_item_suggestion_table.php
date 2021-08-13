<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemSuggestionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_suggestion', function (Blueprint $table) {
            $table->increments('id');
		    $table->integer('order_list_detail_id')->unsigned();
		    $table->integer('order_list_detail_order_list_id')->unsigned();
		    $table->string('description', 200);
		    $table->decimal('price', 30, 2);
		    $table->string('link', 200)->nullable();
		    $table->string('image', 200)->nullable();
		    $table->string('add_info', 200)->nullable();
		
		    $table->index(['order_list_detail_id', 'order_list_detail_order_list_id'],'fk_order_list_detail_suggestion_order_list_detail1_idx');
		
		    $table->foreign('order_list_detail_id')
		        ->references('id')->on('order_list_item');
		
		    $table->foreign('order_list_detail_order_list_id')
		        ->references('order_list_id')->on('order_list_item');
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
        Schema::dropIfExists('item_suggestion');
    }
}
