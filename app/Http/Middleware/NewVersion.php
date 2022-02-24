<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

class NewVersion
{

    /**
     * @param Request $request
     * @param Closure $next
     * @return Application|Factory|View|mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Session::get('spa') === true && !is_null($route = Route::current()) && !$route->named('old-version')) {
            return response()->view('spa');
        }
        return $next($request);
    }
}
