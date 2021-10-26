<?php

declare(strict_types=1);

namespace App\Http\Controllers\Home;

use App\Models\Quiz;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Inertia\Inertia;
use Inertia\Response;

use function compact;

class HomeController
{
    public function __invoke(string $gameUuid): Response
    {
        $quizzes = Quiz::query()
            ->with(
                [
                    'answers' => function (HasMany $hasMany) {
                        $hasMany->inRandomOrder();
                    }
                ]
            )
            ->get()
            ->take(20);

        return Inertia::render(
            'Landing/Home',
            compact(
                'quizzes',
                'gameUuid'
            )
        );
    }
}
