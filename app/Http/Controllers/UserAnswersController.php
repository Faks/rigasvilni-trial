<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\UserAnswers;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

use function compact;
use function redirect;
use function view;

class UserAnswersController extends Controller
{
    public function index(): Factory|View|Application
    {
        $UserAnswers = UserAnswers::query()->paginate(15);

        return view(
            'pages.UserAnswers.index',
            compact(
                "UserAnswers"
            )
        );
    }

    public function show(UserAnswers $userAnswers): Factory|View|Application
    {
        return view(
            "pages.UserAnswers.show",
            compact(
                'UserAnswers'
            )
        );
    }

    public function create(): Factory|View|Application
    {
        return view('pages.UserAnswers.index');
    }

    public function store(UserAnswersRequest $request): RedirectResponse
    {
        $validated = collect($request->validated());

        UserAnswers::query()->create(
            $validated->toArray()
        );

        return redirect()
            ->route("admin.UserAnswers.index")
            ->with('success', 'Stored');
    }

    public function edit(UserAnswersRequest $request, UserAnswers $userAnswers): Factory|View|Application
    {
        return view(
            'pages.UserAnswers.edit',
            compact(
                'UserAnswers',
            )
        );
    }

    public function update(UserAnswersRequest $request, UserAnswers $userAnswers): RedirectResponse
    {
        $validated = collect($request->validated());

        $userAnswers->update($validated->toArray());

        return redirect()
            ->route('admin.UserAnswers.index')
            ->with('success', 'Updated');
    }

    public function destroy(UserAnswers $userAnswers): RedirectResponse
    {
        $userAnswers->delete();

        return redirect()
            ->route("admin.UserAnswers.index")
            ->with('success', 'Deleted');
    }
}
