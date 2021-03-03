<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Addprovi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('provice_tour', function (Blueprint $table) {
            $table->string("slug");
            $table->string('title')->nullable();
            $table->longText('content')->nullable();
            $table->integer('language_id')->nullable();
            $table->string('price')->nullable();
            $table->string('location');
            $table->string('place');
            $table->string('date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
