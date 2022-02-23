<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Tag;
use Illuminate\Http\Request;
use Throwable;

class TagRepository
{

    /**
     * @param Request $request
     * @return Tag
     */
    public function createByRequest(Request $request): Tag
    {
        $request->validate([
            'name' => ['required', 'min:3', 'max:100', 'string', 'unique:tags'],
        ]);
        return Tag::create($request->only(['name']));
    }

    /**
     * @param Tag $tag
     * @param Request $request
     * @return void
     * @throws Throwable
     */
    public function updateByRequest(Tag $tag, Request $request): void
    {
        $request->validate([
            'name' => ['required', 'min:3', 'max:100', 'string', 'unique:tags'],
        ]);
        $tag->updateOrFail($request->only('name'));
    }

    /**
     * @param Tag $tag
     * @param array<int, int>|null $posts
     * @return void
     */
    public function detachPosts(Tag $tag, array $posts = null): void
    {
        if (is_null($posts)) {
            $tag->posts()->detach($tag->posts()->allRelatedIds()->all());
            return;
        }
        $tag->posts()->detach($posts);
    }
}
