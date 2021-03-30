<?php

namespace Database\Factories;

use App\Models\Note;
use Illuminate\Database\Eloquent\Factories\Factory;

class NoteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Note::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // return [
        //     //
        // ];

        $factory->define(App\Note::class, function (Faker $faker) {
        return [
        'name' => $faker->sentence,
        'description' => $faker->paragraph,
        'note_id' => 1,

        ];
});
    }
}
