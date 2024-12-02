<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerMailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_mails', function (Blueprint $table) {
            $table->id();
            $table->string('name',191);
            $table->string('companyname',191);
            $table->string('email',191);
            $table->string('phone',191);
            $table->string('product_id',191);
            $table->text('message');
            $table->string('read_status',191)->default('unread');
            $table->string('delete_status',191)->default(0);
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
        Schema::dropIfExists('customer_mails');
    }
}
