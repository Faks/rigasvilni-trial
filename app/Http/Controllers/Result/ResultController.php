<?php

declare(strict_types=1);

namespace App\Http\Controllers\Result;

use App\Http\Controllers\Controller;
use App\Models\UserAnswers;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

use function compact;

class ResultController extends Controller
{
    public function __invoke(string $gameUuid, Request $request): Response
    {
        $userAnswers = UserAnswers::query()
            ->where('ip_address', $request->ip())
            ->where('game_uuid', '=', $gameUuid)
            ->with(
                [
                    'answer.quiz.answers' => function (HasMany $hasMany) {
                        $hasMany->where('is_correct', '=', true);
                    }
                ]
            )
            ->get();

        return Inertia::render(
            'Result/Result',
            compact('userAnswers')
        );
    }
}
