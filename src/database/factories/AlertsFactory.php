<?php

namespace Database\Factories;

use App\Models\Alerts;
use Illuminate\Database\Eloquent\Factories\Factory;

class AlertsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Alerts::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'onsite' =>  $this->faker->boolean,
            'class' =>  "danger",
            'message' =>  $this->faker->text(), // password
            'tweetid' =>  $this->faker->randomNumber(5, false),
            'discordid' =>  $this->faker->randomNumber(5, false)
        ];
    }
}
