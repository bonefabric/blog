<?php

declare(strict_types=1);

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class BlogController extends Controller
{

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('index')->with('posts', Post::select('id', 'name')
            ->with('tags')
            ->get());
    }

    /**
     * @param int $id
     * @return Application|Factory|View
     */
    public function post(int $id)
    {
        return view('blog.post')->with('post', Post::findOrFail($id));
    }
}
