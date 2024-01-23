<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; 
use Faker\Factory as Faker;

class FilmFakerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Crear una instancia de Faker
        $faker = Faker::create();

        // Generar 10 películas ficticias
        for ($i = 0; $i < 10; $i++) {
            DB::table('films')->insert([ 
                'name' => $faker->text(100),
                'year' => $faker->year('now'),
                'genre' => $faker->text(50),
                'country' => $faker->text(30),
                'duration' => $faker->randomNumber(2),
                'img_url' => $faker->imageUrl(255, 255), 
                'updated_at' => now(),
            ]);
        }
    }
}
