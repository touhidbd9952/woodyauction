<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuctionProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auction_products', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id');
            $table->float('bid_start_price',8,2); //action start price
            $table->float('bid_increase_decrease_price',8,2);
            $table->float('higest_bidding_price',8,2)->default(0);
            $table->string('time_left_for_bidding'); //day hour minute
            $table->string('bidding_result');
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
        Schema::dropIfExists('auction_products');
    }
}
