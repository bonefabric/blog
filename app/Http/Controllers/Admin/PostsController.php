<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class PostsController extends AdminController
{

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('admin.posts.index')
            ->with('posts', Post::all(['id', 'name'])->sortDesc());
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('admin.posts.create')->with('tags', Tag::all('id', 'name'));
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
            'tag' => ['required'],
        ]);
        $post = Post::create($request->only('name', 'content'));
        $post->tags()->attach(Tag::findOrFail($request->input('tag'))->id);
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

    public function edit(int $id)
    {
        return view('admin.posts.edit')
            ->with('post', Post::findOrFail($id))
            ->with('tags', Tag::all(['id', 'name']));
    }

    public function update(Request $request, int $id)
    {
        $request->validate([
            'name' => ['required', 'min:3', 'max:255', 'string'],
            'content' => ['required', 'max:999999'],
            'tag' => ['required'],
        ]);
        /** @var Post $post */
        $post = Post::findOrFail($id);
        $post->updateOrFail($request->only(['name', 'content']));
        $tag = Tag::findOrFail($request->input('tag'));
        if (!$post->tags()->allRelatedIds()->contains($tag->id)) {
            $post->tags()->attach($tag);
        }
        return redirect(route('admin.posts.show', $post->id));
    }

    /**
     * @param int $id
     * @return Application|RedirectResponse|Redirector
     */
    public function destroy(int $id)
    {
        Post::findOrFail($id)->delete();
        return redirect(route('admin.posts.index'));
    }
}
