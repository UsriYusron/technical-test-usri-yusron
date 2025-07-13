<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        User::create([
            'username' => 'admin',
            'password' => Hash::make('pastibisa'),
            'name' => $faker->unique()->name,
            'email' => $faker->unique()->safeEmail,
            'phone' => $faker->phoneNumber,
        ]);
    }
}

