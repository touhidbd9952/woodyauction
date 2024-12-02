<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBidderRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bidder_requests', function (Blueprint $table) {
            $table->id();
            $table->string('name'); 
            $table->string('address'); 
            $table->string('postcode'); 
            $table->string('country'); 
            $table->string('email1'); 
            $table->string('email2')->nullable(); 
            $table->string('phone1'); 
            $table->string('phone2')->nullable();
            $table->string('fax')->nullable(); 
            $table->string('company')->nullable(); 
            $table->string('person_incharge')->nullable(); 
            $table->string('other_auction')->nullable(); 
            $table->integer('read_status')->default(0);
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
        Schema::dropIfExists('bidder_requests');
    }
}
