<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UserTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->delete();
        $faker = Faker::create();

        for ($i = 0; $i < 10; ++$i) {
            DB::table('users')->insert([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('password' . $i),
                'admin' => rand(0, 1),
            ]);
        }
    }
}
