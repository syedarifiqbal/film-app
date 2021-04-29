<?php

namespace Database\Factories;

use App\Models\Film;
use Illuminate\Database\Eloquent\Factories\Factory;

class FilmFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Film::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $path = $this->faker->image(storage_path('app/public'), 600, 400);
        $file = pathinfo($path, PATHINFO_BASENAME);

        return [
            'name'          => $this->faker->name,
            'description'   => $this->faker->text,
            'release_date'  => $this->faker->date(),
            'rating'        => rand(1, 5),
            'ticket_price'  => $this->faker->randomNumber(2),
            'country'       => $this->faker->country,
            'gerne'         => $this->faker->words(rand(2,5)),
            'photo'         => $file,
        ];
    }
}
