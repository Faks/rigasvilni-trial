<?php

declare(strict_types=1);

namespace App\Http\Controllers\UserAnswer;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserAnswerRequest;
use App\Models\UserAnswers;
use Illuminate\Http\RedirectResponse;

use function redirect;

class UserAnswersController extends Controller
{
    public function store(UserAnswerRequest $request, string $gameUuid): RedirectResponse
    {
        $validated = collect($request->validated())
            ->prepend($request->ip(), 'ip_address')
            ->prepend($gameUuid, 'game_uuid');

        UserAnswers::query()->create(
            $validated->toArray()
        );

        return redirect()
            ->route("home", $gameUuid)
            ->with('success', 'User Answer Stored');
    }
}
