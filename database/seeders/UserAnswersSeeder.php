<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\UserAnswers;
use Illuminate\Database\Seeder;

class UserAnswersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        UserAnswers::factory(10)->create();
    }
}
