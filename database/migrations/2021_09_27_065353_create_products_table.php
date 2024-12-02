<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_no'); //use for auction no
            $table->string('name_en')->nullable();
            $table->string('name_jp')->nullable(); //product name
            $table->string('name_slag_en')->nullable();
            $table->string('name_slag_jp')->nullable();
            $table->integer('category_id'); //category id seperated by commas like 1,2,3
            $table->string('thumbnail_image')->nullable();
            $table->string('thumbnail_sm_image')->nullable();
            $table->string('conditional_report')->nullable();
            $table->integer('brand_id')->nullable();
            $table->string('model_no')->nullable();
            $table->string('serial_no')->nullable();
            $table->string('model_year')->nullable();
            $table->string('used_hour')->nullable();
            $table->decimal('buy_price',12,2)->default(0.00);
            $table->decimal('sale_price',12,2)->default(0.00);
            $table->text('short_description')->nullable();
            $table->text('short_description_jp')->nullable();
            $table->text('long_description')->nullable();
            $table->text('long_description_jp')->nullable();
            $table->string('delivery_place')->nullable();
            $table->string('delivery_status')->nullable();
            $table->decimal('releasing_charge',12,2)->default(0.00);
            $table->string('allow_comment')->default('no'); //yes,no
            $table->integer('woner_id');
            $table->integer('user_id');
            $table->string('stock')->default('available'); // available,negotiating,sold out
            $table->string('status')->default('active'); //active,inactive

            //product action start
            $table->integer('auction_product')->default(0); //0,1| 0= no auction, 1=action
            $table->string('auction_date')->nullable(); 
		    $table->decimal('bid_start_price',12,2)->default(0.00); //auction start price
            $table->decimal('bid_increase_decrease_price',12,2)->default(0.00); //auction increase_decrease price
            $table->decimal('higest_bidding_price',12,2)->default(0.00); //it update when a bidder own the bid
            $table->string('start_time_of_auction')->nullable(); //day hour minute left for auction
            $table->string('end_time_of_auction')->nullable(); //day hour minute left for auction
            $table->string('bidding_result')->nullable(); //yes,no  yes: own the bid
            //product action end

            //action bidding start
            $table->decimal('auction_max_autobid_amount',12,2)->default(0.00); 
            $table->decimal('auction_max_bid_amount',12,2)->default(0.00); 
            $table->integer('auction_max_bidder_id')->default(0); 
            $table->string('bid_system')->default('bid'); // bid,auto bid
		    $table->decimal('auction_2ndmax_bid_amount',12,2)->default(0.00); //auction start price
            $table->integer('auction_2ndmax_bidder_id')->default(0); //it update when a bidder own the bid
            $table->integer('total_bids')->default(0); 
            $table->decimal('need_to_pay',12,2)->default(0.00); //day hour minute left for auction
            //action bidding end
            $table->string('final_result')->default('unsold'); //yes,no  yes: own the bid

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
        Schema::dropIfExists('products');
    }
}
