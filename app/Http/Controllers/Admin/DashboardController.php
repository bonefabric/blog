<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class DashboardController extends AdminController
{

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('admin.index');
    }
}
