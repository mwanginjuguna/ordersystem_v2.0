<?php

namespace Database\Factories;

use App\Models\Chat;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory
 */
class ChatFactory extends Factory
{
    /**
     * name of the corresponding model
     * @var string
     */
    protected $model = Chat::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->randomElement([11, 13, 3]),
            'recipient_id' => 1,
            'description' => $this->faker->paragraph(),
            'title' => $this->faker->realTextBetween(40, 80, 3),
            'draft' => $this->faker->boolean(20)
        ];
    }
}
