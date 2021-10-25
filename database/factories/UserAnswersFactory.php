<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\UserAnswers;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserAnswersFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserAnswers::class;

    /**
     * Define the model's default state.
     *
     * @return array
     * @throws \Exception
     */
    public function definition(): array
    {
        return [
            'user_id' => random_int(0, 9223372036854775807),
            'answer_id' => random_int(0, 9223372036854775807)
        ];
    }
}
