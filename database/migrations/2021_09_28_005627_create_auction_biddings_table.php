<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuctionBiddingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auction_biddings', function (Blueprint $table) {
            $table->id();
            $table->string('auction_no'); //year+w+month+a+auction_no  2021w09a01
            $table->integer('product_id');
            $table->decimal('max_bidder_amount',12,2);
            $table->integer('max_bidder_id'); 
            $table->decimal('2nd_max_bidder_amount',12,2);
            $table->integer('2nd_max_bidder_id');
            $table->decimal('need_to_pay',12,2); // bid,auto bid
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
        Schema::dropIfExists('auction_biddings');
    }
}
