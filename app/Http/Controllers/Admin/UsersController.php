<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Events\UserBanned;
use App\Models\User;
use App\Repositories\UserRepository;
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
     * @param UserRepository $userRepository
     * @return Application|RedirectResponse|Redirector
     */
    public function ban(int $id, Request $request, UserRepository $userRepository)
    {
        $request->validate(['banned' => ['required', 'bool']]);
        $userRepository->ban($id, !$request->input('banned'));
        return redirect(route('admin.users'));
    }
}
