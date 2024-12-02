<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuctionHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auction_histories', function (Blueprint $table) { 
            $table->id();
            $table->string('auction_no'); //year+w+month+a+auction_no  2021w09a01
            $table->integer('product_id');
            $table->integer('bidder_id');
            $table->decimal('bidding_price',12,2); 
            $table->string('bid_system')->default('bid'); // bid,auto bid
            $table->integer('highest_bidder');
            $table->string('bid_time')->nullable();
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
        Schema::dropIfExists('auction_histories');
    }
}
