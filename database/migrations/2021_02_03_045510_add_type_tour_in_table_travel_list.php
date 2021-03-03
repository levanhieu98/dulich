<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTypeTourInTableTravelList extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('travel_lists', function (Blueprint $table) {
            if (!Schema::hasColumn('travel_lists', 'type_of_tour_id')) {
                $table->integer('type_of_tour_id')->after('content')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('travel_lists', function (Blueprint $table) {
            if (!Schema::hasColumn('travel_lists', 'type_of_tour_id')) {
                $table->integer('type_of_tour_id')->after('content')->nullable();
            }
        });
    }
}
