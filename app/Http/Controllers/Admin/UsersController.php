<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class UsersController extends AdminController
{

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('admin.users.index')
            ->with('users', User::select(['id', 'name', 'email', 'banned'])->get());
    }

    /**
     * @param int $id
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     */
    public function ban(int $id, Request $request)
    {
        $request->validate([
            'ban' => ['required', 'bool'],
        ]);
        $user = User::findOrFail($id);

        if ((bool)$request->input('ban') !== $user->banned) {
            $user->banned = !$user->banned;
            $user->save();
        }

        return redirect(route('admin.users'));
    }
}
