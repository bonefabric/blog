<?php

declare(strict_types=1);

namespace App\Repositories;

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
        return User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);
    }

    /**
     * @param int $id
     * @param bool $ban
     * @return void
     */
    public function ban(int $id, bool $ban = true): void
    {
        User::findOrFail($id)->update(['banned' => $ban]);
    }
}
