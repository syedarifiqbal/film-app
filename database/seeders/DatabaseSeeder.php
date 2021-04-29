<?php

namespace Database\Seeders;

use App\Models\Film;
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
        $seeder = new FilmSeeder();
        $films = $seeder->run();
        $films->each(function($film){
            \App\Models\Comment::factory(1)->create(['film_id' => $film->id]);
        });;
    }
}
