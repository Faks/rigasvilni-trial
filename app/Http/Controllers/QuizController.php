<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Quiz;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

use function compact;
use function redirect;
use function view;

class QuizController extends Controller
{
    public function index(): Factory|View|Application
    {
        $Quiz = Quiz::query()->paginate(15);

        return view(
            'pages.Quiz.index',
            compact(
                "Quiz"
            )
        );
    }

    public function show(Quiz $quiz): Factory|View|Application
    {
        return view(
            "pages.Quiz.show",
            compact(
                'Quiz'
            )
        );
    }

    public function create(): Factory|View|Application
    {
        return view('pages.Quiz.index');
    }

    public function store(QuizRequest $request): RedirectResponse
    {
        $validated = collect($request->validated());

        Quiz::query()->create(
            $validated->toArray()
        );

        return redirect()
            ->route("admin.Quiz.index")
            ->with('success', 'Stored');
    }

    public function edit(QuizRequest $request, Quiz $quiz): Factory|View|Application
    {
        return view(
            'pages.Quiz.edit',
            compact(
                'Quiz',
            )
        );
    }

    public function update(QuizRequest $request, Quiz $quiz): RedirectResponse
    {
        $validated = collect($request->validated());

        $quiz->update($validated->toArray());

        return redirect()
            ->route('admin.Quiz.index')
            ->with('success', 'Updated');
    }

    public function destroy(Quiz $quiz): RedirectResponse
    {
        $quiz->delete();

        return redirect()
            ->route("admin.Quiz.index")
            ->with('success', 'Deleted');
    }
}
