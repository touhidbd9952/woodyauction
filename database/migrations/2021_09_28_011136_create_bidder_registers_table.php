<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBidderRegistersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bidder_registers', function (Blueprint $table) {
            $table->id();
            $table->string('usercodeno');
            $table->string('username');
            $table->string('password');
            $table->integer('password_verify')->default(0);

            $table->string('name');
            $table->string('company_name');
            $table->string('person_incharge');
            
            
            $table->string('address');
            $table->string('country');
            $table->string('zip_code');

            $table->string('email1');
            $table->string('email2')->nullable();
            $table->string('phone1');
            $table->string('phone2')->nullable();
            $table->string('fax')->nullable();

            $table->string('membership_with_other_auctioneers')->nullable();
            $table->text('selection')->nullable();
            $table->string('status')->default('active'); //active, inactive | it will use to controll bidder member   
            $table->string('permission')->default('inapprove'); //approve, inapprove
            $table->integer('user_id'); //user id of admin who will do permition, account status change
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
        Schema::dropIfExists('bidder_registers');
    }
}
