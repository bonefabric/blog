<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;

class VersionController extends Controller
{

    /**
     * @return RedirectResponse
     */
    public function newVersion(): RedirectResponse
    {
        Session::put('spa', true);
        return redirect()->route('home');
    }

    /**
     * @return RedirectResponse
     */
    public function oldVersion(): RedirectResponse
    {
        Session::remove('spa');
        return redirect()->route('home');
    }
}
