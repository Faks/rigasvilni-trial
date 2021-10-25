<?php

declare(strict_types=1);

namespace Database\Seeders;

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
        $this->call(UserSeeder::class);
        $this->call(QuizSeeder::class);
        $this->call(AnswerSeeder::class);
        $this->call(UserAnswersSeeder::class);
    }
}
