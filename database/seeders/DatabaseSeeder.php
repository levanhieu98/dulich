<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //App\Models\User::factory(10)->create();
        $this->call(UserSeeder::class);
        $this->call(Add_Role::class);
        $this->call(Permission::class);
        $this->call(rol_has_permissin::class);
        $this->call(model_has_role::class);
        $this->call(Language::class);
        $this->call(MapSeeder::class);
        $this->call(TypeOfTour::class);
    }
}