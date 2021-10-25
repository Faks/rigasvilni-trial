<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Answer;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

use function compact;
use function redirect;
use function view;

class AnswerController extends Controller
{
    public function index(): Factory|View|Application
    {
        $Answer = Answer::query()->paginate(15);

        return view(
            'pages.Answer.index',
            compact(
                "Answer"
            )
        );
    }

    public function show(Answer $answer): Factory|View|Application
    {
        return view(
            "pages.Answer.show",
            compact(
                'answer'
            )
        );
    }

    public function create(): Factory|View|Application
    {
        return view('pages.Answer.index');
    }

    public function store(AnswerRequest $request): RedirectResponse
    {
        $validated = collect($request->validated());

        Answer::query()->create(
            $validated->toArray()
        );

        return redirect()
            ->route("admin.Answer.index")
            ->with('success', 'Stored');
    }

    public function edit(AnswerRequest $request, Answer $answer): Factory|View|Application
    {
        return view(
            'pages.Answer.edit',
            compact(
                'Answer',
            )
        );
    }

    public function update(AnswerRequest $request, Answer $answer): RedirectResponse
    {
        $validated = collect($request->validated());

        $answer->update($validated->toArray());

        return redirect()
            ->route('admin.Answer.index')
            ->with('success', 'Updated');
    }

    public function destroy(Answer $answer): RedirectResponse
    {
        $answer->delete();

        return redirect()
            ->route("admin.Answer.index")
            ->with('success', 'Deleted');
    }
}
