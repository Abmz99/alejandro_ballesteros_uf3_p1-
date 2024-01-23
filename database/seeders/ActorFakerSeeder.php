<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; 
use Faker\Factory as Faker;

class ActorFakerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Crear una instancia de Faker
        $faker = Faker::create();

        // Generar 10 actores ficticios
        for ($i = 0; $i < 10; $i++) {
            DB::table('actors')->insert([ 
                'name' => $faker->firstName,
                'surname' => $faker->lastName,
                'birthdate' => $faker->date('Y-m-d'),
                'country' => $faker->country,
                'img_url' => $faker->imageUrl(255, 255), 
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
