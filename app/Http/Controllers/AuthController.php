<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{

    /**
     * @return Application|Factory|View
     */
    public function loginView()
    {
        return view('login');
    }

    /**
     * @param Request $request
     * @return Application|JsonResponse|RedirectResponse|Redirector
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($request->only(['email', 'password']), $request->input('remember'))) {
            Session::regenerate();
            if ($request->input('spa') === 'spa') {
                return response()->json(['result' => true]);
            }
            return redirect(route('home'));
        }

        return redirect()->back()->withErrors(['email' => 'The provided credentials do not match our records.']);
    }

    /**
     * @return Application|Factory|View
     */
    public function registerView()
    {
        return view('register');
    }

    public function register(Request $request, UserRepository $userRepository)
    {
        Auth::login($userRepository->createByRequest($request));
        return redirect(route('admin.index'));
    }

    /**
     * @return Application|RedirectResponse|Redirector
     */
    public function logout()
    {
        Auth::logout();
        return redirect(route('home'));
    }

}
