<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Quiz;
use Inertia\Inertia;
use Inertia\Response;

use function compact;

class HomeController
{
    public function __invoke(): Response
    {
        $quizzes = Quiz::query()
            ->with([
                'answers'
            ])
            ->get()
            ->take(20);

        return Inertia::render(
            'Landing/Home',
            compact('quizzes')
        );
    }
}
