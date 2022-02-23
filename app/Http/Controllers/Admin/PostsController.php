<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Models\Tag;
use App\Repositories\PostRepository;
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
     * @param PostRepository $postRepository
     * @return Application|RedirectResponse|Redirector
     */
    public function store(Request $request, PostRepository $postRepository)
    {
        $tags = $request->collect()
            ->filter(function ($value, $key) {
                return str_starts_with($key, 'tag_');
            })
            ->keys()
            ->map(function ($tag) {
                return (int)ltrim($tag, 'tag_');
            });

        $postRepository->attachTags($postRepository->createByRequest($request), $tags->all());
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
     * @param int $id
     * @param Request $request
     * @param PostRepository $postRepository
     * @return Application|RedirectResponse|Redirector
     * @throws Throwable
     */
    public function update(int $id, Request $request, PostRepository $postRepository)
    {
        $postRepository->updateByRequest($post = Post::findOrFail($id), $request);

        $tags = $request->collect()
            ->filter(function ($value, $key) {
                return str_starts_with($key, 'tag_');
            })
            ->keys()
            ->map(function ($tag) {
                return (int)ltrim($tag, 'tag_');
            });

        DB::transaction(function () use ($post, $tags, $postRepository) {

            $postRepository->detachTags($post, $post->tags()
                ->allRelatedIds()
                ->filter(function ($tag) use ($tags) {
                    return !$tags->contains($tag);
                })
                ->all());

            $postRepository->attachTags($post, $tags->filter(function ($value) use ($post) {
                return !$post->tags()->allRelatedIds()->contains($value);
            })->all());
        });

        return redirect(route('admin.posts.show', $post->id));
    }

    /**
     * @param int $id
     * @param Request $request
     * @param PostRepository $postRepository
     * @return Application|RedirectResponse|Redirector
     */
    public function destroy(int $id, Request $request, PostRepository $postRepository)
    {
        $post = Post::withTrashed()->findOrFail($id);

        if ($request->input('permanently')) {
            $postRepository->detachTags($post);
            $post->forceDelete();
        } elseif ($post->trashed()) {
            $post->restore();
        } else {
            $post->delete();
        }

        return redirect(route('admin.posts.index'));
    }
}
