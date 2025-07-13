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
        // \App\Models\User::factory(10)->create();

        // seeder user
        $this->call(UserSeeder::class);

        // seeder divisi
        $this->call(DivisiSeeder::class);
    }
}
