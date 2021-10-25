<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

use function compact;
use function redirect;
use function view;

class UserController extends Controller
{
    public function index(): Factory|View|Application
    {
        $User = User::query()->paginate(15);

        return view(
            'pages.User.index',
            compact(
                "User"
            )
        );
    }

    public function show(User $user): Factory|View|Application
    {
        return view(
            "pages.User.show",
            compact(
                'User'
            )
        );
    }

    public function create(): Factory|View|Application
    {
        return view('pages.User.index');
    }

    public function store(UserRequest $request): RedirectResponse
    {
        $validated = collect($request->validated());

        User::query()->create(
            $validated->toArray()
        );

        return redirect()
            ->route("admin.User.index")
            ->with('success', 'Stored');
    }

    public function edit(UserRequest $request, User $user): Factory|View|Application
    {
        return view(
            'pages.User.edit',
            compact(
                'User',
            )
        );
    }

    public function update(UserRequest $request, User $user): RedirectResponse
    {
        $validated = collect($request->validated());

        $user->update($validated->toArray());

        return redirect()
            ->route('admin.User.index')
            ->with('success', 'Updated');
    }

    public function destroy(User $user): RedirectResponse
    {
        $user->delete();

        return redirect()
            ->route("admin.User.index")
            ->with('success', 'Deleted');
    }
}
