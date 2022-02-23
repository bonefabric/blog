<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Post;
use Illuminate\Http\Request;
use Throwable;

class PostRepository
{

    /**
     * @param Request $request
     * @return Post
     */
    public function createByRequest(Request $request): Post
    {
        $request->validate([
            'name' => ['required', 'min:3', 'max:255', 'string'],
            'content' => ['required', 'max:999999'],
        ]);
        return Post::create($request->only('name', 'content'));
    }

    /**
     * @param Post $post
     * @param Request $request
     * @return void
     * @throws Throwable
     */
    public function updateByRequest(Post $post, Request $request): void
    {
        $request->validate([
            'name' => ['required', 'min:3', 'max:255', 'string'],
            'content' => ['required', 'max:999999'],
        ]);
        $post->updateOrFail($request->only(['name', 'content']));
    }

    /**
     * @param Post $post
     * @param array<int, int> $tags
     * @return void
     */
    public function attachTags(Post $post, array $tags): void
    {
        $post->tags()->attach($tags);
    }

    /**
     * @param Post $post
     * @param array<int, int>|null $tags
     * @return void
     */
    public function detachTags(Post $post, array $tags = null): void
    {
        if (is_null($tags)) {
            $post->tags()->detach($post->tags()->allRelatedIds()->all());
            return;
        }
        $post->tags()->detach($tags);
    }
}
