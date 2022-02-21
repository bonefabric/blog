<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class ProfileController extends Controller
{

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('profile');
    }

}
