<?php

namespace Database\Factories;

use App\Models\ContactResponses;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactResponsesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ContactResponses::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'Name' => $this->faker->name,
            'Email' => $this->faker->unique()->safeEmail,
            'Subject' => $this->faker->sentence,
            'Message' => $this->faker->paragraph
        ];
    }
}
