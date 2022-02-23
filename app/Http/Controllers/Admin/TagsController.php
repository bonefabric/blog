<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use App\Repositories\TagRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Throwable;

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
     * @param TagRepository $tagRepository
     * @return Application|RedirectResponse|Redirector
     */
    public function store(Request $request, TagRepository $tagRepository)
    {
        return redirect(route('admin.tags.show', $tagRepository->createByRequest($request)->id));
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
     * @param int $id
     * @param Request $request
     * @param TagRepository $tagRepository
     * @return Application|RedirectResponse|Redirector
     * @throws Throwable
     */
    public function update(int $id, Request $request, TagRepository $tagRepository)
    {
        $tagRepository->updateByRequest(Tag::findOrFail($id), $request);
        return redirect(route('admin.tags.show', $id));
    }

    /**
     * @param int $id
     * @param Request $request
     * @param TagRepository $tagRepository
     * @return Application|RedirectResponse|Redirector
     */
    public function destroy(int $id, Request $request, TagRepository $tagRepository)
    {
        $tag = Tag::withTrashed()->findOrFail($id);

        if ($request->input('permanently')) {
            $tagRepository->detachPosts($tag);
            $tag->forceDelete();
        } elseif ($tag->trashed()) {
            $tag->restore();
        } else {
            $tag->delete();
        }

        return redirect(route('admin.tags.index'));
    }
}
