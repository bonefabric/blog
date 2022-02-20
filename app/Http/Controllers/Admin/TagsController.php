<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Throwable;

class TagsController extends Controller
{

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('admin.tags.index')->with('tags', Tag::all());
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
        $tag = Tag::findOrFail($id);
        return view('admin.tags.edit')->with('tag', $tag);

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
     * @return Application|RedirectResponse|Redirector
     * @throws Throwable
     */
    public function destroy(int $id)
    {
        Tag::findOrFail($id)->delete();
        return redirect(route('admin.tags.index'));
    }
}
