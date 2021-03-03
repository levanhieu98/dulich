<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Permission extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
            [
                'name' => "blog",
                'guard_name' => "web",
            ],
            [
                'name' => "category",
                'guard_name' => "web",
            ],
            [
                'name' => "language",
                'guard_name' => "web",
            ],
            [
                'name' => "user",
                'guard_name' => "web",
            ],
            [
                'name' => "user_review",
                'guard_name' => "web",
            ],
            [
                'name' => "tag",
                'guard_name' => "web",
            ],
            [
                'name' => "tourist",
                'guard_name' => "web",
            ],
        ]);
    }
}
