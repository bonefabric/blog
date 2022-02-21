<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Throwable;

class PostsController extends AdminController
{

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('admin.posts.index')
            ->with('posts', Post::select(['id', 'name', 'deleted_at'])
                ->withTrashed()
                ->orderBy('deleted_at')
                ->orderBy('updated_at', 'desc')
                ->get());
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('admin.posts.create')->with('tags', Tag::select('id', 'name')->get());
    }

    /**
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'min:3', 'max:255', 'string'],
            'content' => ['required', 'max:999999'],
        ]);

        /** @var Post $post */
        $post = Post::create($request->only('name', 'content'));

        $tags = $request->collect()
            ->filter(function ($value, $key) {
                return str_starts_with($key, 'tag_');
            })
            ->keys()
            ->map(function ($tag) {
                return (int)ltrim($tag, 'tag_');
            });

        $post->tags()->attach($tags->all());
        return redirect(route('admin.posts.index'));
    }

    /**
     * @param int $id
     * @return Application|Factory|View
     */
    public function show(int $id)
    {
        return view('admin.posts.show')->with('post', Post::findOrFail($id));
    }

    /**
     * @param int $id
     * @return Application|Factory|View
     */
    public function edit(int $id)
    {
        return view('admin.posts.edit')
            ->with('post', Post::findOrFail($id))
            ->with('tags', Tag::all(['id', 'name']));
    }

    /**
     * @param Request $request
     * @param int $id
     * @return Application|RedirectResponse|Redirector
     * @throws Throwable
     */
    public function update(Request $request, int $id)
    {
        $request->validate([
            'name' => ['required', 'min:3', 'max:255', 'string'],
            'content' => ['required', 'max:999999'],
        ]);
        /** @var Post $post */
        $post = Post::findOrFail($id);
        $post->updateOrFail($request->only(['name', 'content']));

        $tags = $request->collect()
            ->filter(function ($value, $key) {
                return str_starts_with($key, 'tag_');
            })
            ->keys()
            ->map(function ($tag) {
                return (int)ltrim($tag, 'tag_');
            });

        DB::transaction(function () use ($post, $tags) {

            $post->tags()->detach($post->tags()
                ->allRelatedIds()
                ->filter(function ($tag) use ($tags) {
                    return !$tags->contains($tag);
                }));

            $post->tags()->attach($tags->filter(function ($value) use ($post) {
                return !$post->tags()->allRelatedIds()->contains($value);
            }));
        });

        return redirect(route('admin.posts.show', $post->id));
    }

    /**
     * @param int $id
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     */
    public function destroy(int $id, Request $request)
    {
        /** @var Post $post */
        $post = Post::withTrashed()->findOrFail($id);

        if ($request->input('permanently')) {
            $post->tags()->detach($post->tags()->allRelatedIds()->all());
            $post->forceDelete();
        } elseif ($post->trashed()) {
            $post->restore();
        } else {
            $post->delete();
        }

        return redirect(route('admin.posts.index'));
    }
}
