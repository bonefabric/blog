<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AuthController extends ApiController
{

    /**
     * @param Request $request
     * @return void
     */
    public function login(Request $request): void
    {
        if (Auth::check()) {
            $this->authorized();
            return;
        }
        $validator = Validator::make(
            $request->only(['email', 'password']),
            [
                'email' => ['required', 'email'],
                'password' => ['required'],
            ]);

        if (!$validator->errors() && Auth::attempt($request->only(['email', 'password']), $request->input('remember', false))) {
            Session::regenerate();
            $this->authorized();
            return;
        }
        $this->unauthorized($validator->errors()->all());
    }

    /**
     * @return void
     */
    private function authorized(): void
    {
        if (Auth::check() && !is_null($user = Auth::user())) {
            $this->sendResponse([
                'isAuthorized' => true,
                'name' => $user->getAttribute('name'),
                'email' => $user->getAttribute('email'),
                'isAdmin' => $user->isAdmin(),
                'isBanned' => $user->isBanned(),
            ]);
            return;
        }
        $this->unauthorized(['The provided credentials do not match our records.']);
    }

    /**
     * @param array $errors
     * @return void
     */
    private function unauthorized(array $errors): void
    {
        $this->sendResponse($errors, 403);
    }
}
