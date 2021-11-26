<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::inRandomOrder()->first(),
            'title' => $this->faker->paragraph(),
            'body' => $this->faker->realText(),
            'due_date' => $this->faker->dateTimeBetween(now(),'+2 month'),
            'urgent' => random_int(0,1),
            'reward_coin' => random_int(1,100) * 100,
        ];
    }
}
