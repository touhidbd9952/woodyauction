<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductWonersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_woners', function (Blueprint $table) {
            $table->id();
            $table->string('name_en')->nullable();
            $table->string('name_jp')->nullable();
            $table->string('company_name_en')->nullable();
            $table->string('company_name_jp')->nullable();
            $table->string('person_incharge_en')->nullable();
            $table->string('person_incharge_jp')->nullable();

            $table->string('address');
            $table->string('postcode');
            $table->string('country');
            $table->string('email1');
            $table->string('email2')->nullable();
            $table->string('fax')->nullable();
            $table->string('phone1');
            $table->string('phone2')->nullable();
            $table->integer('user_id');
            $table->string('status')->default('active'); //active,inactive
            $table->string('permission')->default('inapprove'); //approve,inapprove
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
        Schema::dropIfExists('product_woners');
    }
}
