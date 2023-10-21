<?php

namespace Database\Factories;

use App\Models\Message;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class MessageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Message::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->randomElement([11, 13, 3]),
            'chat_id' => rand(1,6),
            'recipient_id' => 1,
            'recipient_department' => $this->faker->randomElement(['admin', 'developer', 'support team']),
            'message' => $this->faker->paragraph(),
        ];
    }
}
