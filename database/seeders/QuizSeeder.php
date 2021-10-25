<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Quiz;
use Illuminate\Database\Seeder;

class QuizSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Quiz::factory(10)->create();
    }
}
