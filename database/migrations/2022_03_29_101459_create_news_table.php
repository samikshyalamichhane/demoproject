<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('slug')->nullable();
            $table->string('author')->nullable();
            $table->string('image')->nullable();
            $table->string('video')->nullable();
            $table->string('youtube_video_link')->nullable();
            $table->string('tiktok_video_link')->nullable();
            $table->string('facebook_video_link')->nullable();
            $table->text('short_description')->nullable();
            $table->longText('description')->nullable();
            $table->boolean('publish')->default(true);
            $table->boolean('is_verified')->default(false);
            $table->integer('view')->nullable();
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('news');
    }
}
