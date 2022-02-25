<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{

    /**
     * @return Application|ResponseFactory|JsonResponse|Response
     */
    public function getProfile()
    {
        if (Auth::check() && !is_null($user = Auth::user())) {
            return response()->json([
                'name' => $user->getAttribute('name'),
                'email' => $user->getAttribute('email'),
                'isAdmin' => $user->isAdmin(),
                'isBanned' => $user->isBanned(),
            ]);
        }
        return response('Unauthorized', 403);
    }
}
