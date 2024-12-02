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
            $table->integer('cat_id');
            $table->string('title');
            $table->string('title_jp');
            $table->string('thumbnail_image');
            $table->text('short_des');
            $table->text('short_des_jp');
            $table->text('detail_des');
            $table->text('detail_des_jp');
            $table->string('publish_status')->default('unpublish');
            $table->integer('user_id');
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
