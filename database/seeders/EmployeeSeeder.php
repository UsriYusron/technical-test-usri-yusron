<?php

namespace Database\Seeders;

use App\Models\Employees;
use Faker\Factory as Faker;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $faker = Faker::create();

        $divisiIds = DB::table('divisis')->pluck('id'); // mengambil semua ID divisi

        $positions = ['Programmer', 'QA Engineer', 'UI Designer', 'UX Researcher', 'Backend Developer', 'Frontend Developer'];

        for ($i = 0; $i < 20; $i++) {
            Employees::create([
                'id' => (string) Str::uuid(),
                'name' => $faker->name,
                'image' => $faker->imageUrl(150, 150, 'people', true, 'person'),
                'position' => $faker->randomElement($positions),
                'phone' => $faker->phoneNumber,
                'divisi_id' => $faker->randomElement($divisiIds),
            ]);
        }
    }
}
