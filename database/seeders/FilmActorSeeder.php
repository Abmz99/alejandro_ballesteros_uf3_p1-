<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class FilmActorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Crear una instancia de Faker
        $faker = Faker::create();

        // Obtener todas las películas y actores de las tablas correspondientes
        $filmIds = DB::table('films')->pluck('id')->toArray();
        $actorIds = DB::table('actors')->pluck('id')->toArray();

        // Relacionar aleatoriamente las películas con los actores
        foreach ($filmIds as $filmId) {
            // Seleccionar de 1 a 3 actores aleatoriamente
            $randomActorIds = $faker->randomElements($actorIds, $faker->numberBetween(1, 3));

            // Insertar las relaciones en la tabla film_actor
            foreach ($randomActorIds as $actorId) {
                DB::table('films_actors')->insert([
                    'film_id' => $filmId,
                    'actor_id' => $actorId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
