<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOurProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('our_projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('title_jp');
            $table->text('short_des');
            $table->text('short_des_jp');
            $table->text('detail_des');
            $table->text('detail_des_jp');
            $table->string('thumbnail_image');
            $table->string('publish_status')->default('unpublish');
            $table->string('user_id');
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
        Schema::dropIfExists('our_projects');
    }
}
