<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{

    /**
     * @return User|Authenticatable|Application|ResponseFactory|Response|null
     */
    public function getProfile()
    {
        if (Auth::check()) {
            return Auth::user();
        }
        return response('Unauthorized', 403);
    }

}
