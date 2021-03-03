<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeOfTour extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('type_of_tour')->insert([
            [
                'name' => 'Trong tỉnh'
            ],
            [
                'name' => 'Từ ngoài tỉnh',
            ]
        ]);
    }
}
