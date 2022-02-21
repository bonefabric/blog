<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class TagsController extends AdminController
{

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('admin.tags.index')
            ->with('tags', Tag::select(['id', 'name', 'deleted_at'])
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
        return view('admin.tags.create');
    }

    /**
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'min:3', 'max:100', 'string', 'unique:tags'],
        ]);
        $tag = Tag::create($request->only('name'));
        return redirect(route('admin.tags.show', $tag->id));
    }

    /**
     * @param int $id
     * @return Application|Factory|View
     */
    public function show(int $id)
    {
        return view('admin.tags.show')->with('tag', Tag::findOrFail($id));
    }

    /**
     * @param int $id
     * @return Application|Factory|View
     */
    public function edit(int $id)
    {
        return view('admin.tags.edit')->with('tag', Tag::findOrFail($id));
    }

    /**
     * @param Request $request
     * @param int $id
     * @return Application|RedirectResponse|Redirector
     */
    public function update(Request $request, int $id)
    {
        $request->validate([
            'name' => ['required', 'min:3', 'max:100', 'string', 'unique:tags'],
        ]);
        $tag = Tag::findOrFail($id);
        $tag->name = $request->input('name');
        $tag->save();
        return redirect(route('admin.tags.show', $tag->id));
    }

    /**
     * @param int $id
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     */
    public function destroy(int $id, Request $request)
    {
        /** @var Tag $tag */
        $tag = Tag::withTrashed()->findOrFail($id);

        if ($request->input('permanently')) {
            $tag->posts()->detach($tag->posts()->allRelatedIds()->all());
            $tag->forceDelete();
        } elseif ($tag->trashed()) {
            $tag->restore();
        } else {
            $tag->delete();
        }

        return redirect(route('admin.tags.index'));
    }
}
