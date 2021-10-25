<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Answer;
use Illuminate\Database\Seeder;

class AnswerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Answer::factory(10)->create();
    }
}
