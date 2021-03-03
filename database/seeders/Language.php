<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Language extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('languages')->insert([
            [
                'name' => "Việt Nam",
                'iso' => "vi"
            ],
            [
                'name' => "English",
                'iso' => "en"
            ],
        ]);
    }
}
