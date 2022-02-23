<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Events\User\UserBanned;
use App\Events\User\UserRegistered;
use App\Events\User\UserUnbanned;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserRepository
{

    /**
     * @param Request $request
     * @return User
     */
    public function createByRequest(Request $request): User
    {
        $request->validate([
            'name' => ['required', 'string', 'min:2', 'max:100'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'confirmed', 'min:6', 'max:100'],
        ]);
        UserRegistered::dispatch($user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]));
        return $user;
    }

    /**
     * @param int $id
     * @param bool $ban
     * @return void
     */
    public function ban(int $id, bool $ban = true): void
    {
        $user = User::findOrFail($id);
        $user->update(['banned' => $ban]);
        $ban ? UserBanned::dispatch($user) : UserUnbanned::dispatch($user);
    }
}
