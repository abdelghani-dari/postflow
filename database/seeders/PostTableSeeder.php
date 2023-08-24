<?php

   namespace Database\Seeders;

   use Carbon\Carbon;
   use Illuminate\Database\Seeder;
   use Illuminate\Support\Facades\DB;
   use Faker\Factory as Faker;
   
   class PostTableSeeder extends Seeder
   {
       public function run()
       {
           DB::table('posts')->delete();
   
           $faker = Faker::create();
           $now = Carbon::now();
           $oneYearAgo = $now->copy()->subYear();
   
           for ($i = 200; $i < 300; ++$i) {
               $date = $faker->dateTimeBetween($oneYearAgo, $now);
               $title = ucfirst($faker->unique()->words(rand(1, 5), true));
               $content = $title . " is about " . $faker->paragraphs(rand(3, 6), true);
   
               DB::table('posts')->insert([
                   'titre' => $title,
                   'contenu' => $content,
                   'user_id' => rand(1, 10),
                   'created_at' => $date,
                   'updated_at' => $date,
               ]);
           }
       }
   }
   