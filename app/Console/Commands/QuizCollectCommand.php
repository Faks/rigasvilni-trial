<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\Answer;
use App\Models\Quiz;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

use function collect;
use function implode;
use function range;
use function trim;
use function ucfirst;

class QuizCollectCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'quiz:collection';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Collect Quizzes and generate answers to quiz.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $randNumber = range(1, 999);
        $randNumber = implode(',', $randNumber);

        $http = Http::get("http://numbersapi.com/{$randNumber}");

        collect($http->json())
            ->map(function (string $text, string $answer) {
                $response = null;

                if ("$answer is an unremarkable number." !== $text
                    && "$answer is a number for which we're missing a fact (submit one to numbersapi at google mail!)." !== $text
                    && "$answer is an uninteresting number." !== $text
                    && "$answer is a boring number." !== $text
                ) {
                    $response = $text;
                }

                return $response;
            })
            ->filter()
            ->each(function (string $text, string $answer) {
                $title = Str::after($text, 'is');
                $quizAttributes = [
                    'title' => ucfirst(trim($title)),
                ];

                $quiz = Quiz::query()->updateOrCreate(
                    $quizAttributes,
                    $quizAttributes
                );

                foreach (range($answer, ($answer + 2)) as $answerNumber) {
                    $answerAttributes = [
                        'quiz_id' => $quiz->id,
                        'text' => $answerNumber,
                        'is_correct' => (int)$answer === (int)$answerNumber
                            ? 1
                            : 0
                    ];

                    Answer::query()->updateOrCreate(
                        $answerAttributes,
                        $answerAttributes
                    );
                }
            });

        return Command::SUCCESS;
    }
}
