<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string("title");
            $table->string("slug");
            $table->string("image");
            $table->longText("description")->nullable();
            $table->longText("content")->nullable();
            $table->boolean('publish')->nullable()->default(null)->change();
            $table->bigInteger("publish_id")->nullable()->default(null)->unsigned();
            $table->bigInteger("category_id")->unsigned();
            $table->bigInteger("author_id")->unsigned();
            $table->bigInteger("language_id")->unsigned();
            $table->timestamps();

            $table->foreign('publish_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('author_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('language_id')->references('id')->on('languages')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blogs');
    }
}