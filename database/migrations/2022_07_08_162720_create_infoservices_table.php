<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInfoservicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('infoservices', function (Blueprint $table) {
            $table->id();
            $table->integer('auction_id')->nullable();
            $table->integer('bidder_id')->nullable();
            $table->integer('owner_id')->nullable();
            $table->integer('mail_sent')->default(0);
            $table->integer('printout')->default(0);
            $table->integer('fax')->default(0);
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
        Schema::dropIfExists('infoservices');
    }
}
