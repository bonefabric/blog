<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Models\HistoryNote;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class HistoryController extends AdminController
{

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('admin.history.index')->with('notes', HistoryNote::select()
            ->with('user')
            ->orderByDesc('updated_at')
            ->get());
    }
}
