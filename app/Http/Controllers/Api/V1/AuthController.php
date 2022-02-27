<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends ApiController
{

    /**
     * @return JsonResponse
     */
    public function check(): JsonResponse
    {
        if (Auth::check()) {
            return $this->authorized();
        }
        return $this->unauthorized();
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request): JsonResponse
    {
        if (Auth::check()) {
            return $this->authorized();
        }
        $validator = Validator::make(
            $request->only(['email', 'password']),
            [
                'email' => ['required', 'email'],
                'password' => ['required'],
            ]);
        if ($validator->errors()->any()) {
            return $this->unauthorized($validator->errors()->all());
        }
        if (Auth::attempt($request->only(['email', 'password']), $request->input('remember', false))) {
            session()->regenerate();
            return $this->authorized();
        }
        return $this->unauthorized(['The provided credentials do not match our records.']);
    }

    /**
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        Auth::logout();
        return $this->unauthorized();
    }

    /**
     * @return JsonResponse
     */
    private function authorized(): JsonResponse
    {
        if (Auth::check() && !is_null($user = Auth::user())) {
            return $this->sendResponse([
                'profile' => [
                    'isAuthorized' => true,
                    'name' => $user->getAttribute('name'),
                    'email' => $user->getAttribute('email'),
                    'isAdmin' => $user->isAdmin(),
                    'isBanned' => $user->isBanned(),
                ]
            ]);
        }
        return $this->unauthorized(['The provided credentials do not match our records.']);
    }

    /**
     * @param array $errors
     * @return JsonResponse
     */
    private function unauthorized(array $errors = []): JsonResponse
    {
        return $this->sendResponse(['errors' => $errors], 403);
    }
}
