<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Events\Comments\CommentDeleted;
use App\Events\Comments\CommentRestored;
use App\Events\Comments\CommentTrashed;
use App\Models\Comment;
use App\Repositories\CommentRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CommentsController extends AdminController
{

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('admin.comments.index')
            ->with('comments', Comment::select()
                ->withoutGlobalScope('reviewed')
                ->withTrashed()
                ->get());
    }

    /**
     * @param int $id
     * @return Application|Factory|View
     */
    public function show(int $id)
    {
        return view('admin.comments.show')->with('comment', Comment::withoutGlobalScope('reviewed')
            ->withTrashed()
            ->findOrFail($id));
    }

    /**
     * @param int $id
     * @param Request $request
     * @return RedirectResponse
     */
    public function destroy(int $id, Request $request): RedirectResponse
    {
        $comment = Comment::withoutGlobalScope('reviewed')->withTrashed()->findOrFail($id);

        if ($request->input('permanently')) {
            CommentDeleted::dispatch($comment);
            $comment->forceDelete();
        } elseif ($comment->trashed()) {
            CommentRestored::dispatch($comment);
            $comment->restore();
        } else {
            CommentTrashed::dispatch($comment);
            $comment->delete();
        }
        return redirect()->route('admin.comments.index');
    }

    /**
     * @param int $id
     * @param CommentRepository $commentRepository
     * @return RedirectResponse
     */
    public function review(int $id, CommentRepository $commentRepository): RedirectResponse
    {
        $commentRepository->review($id);
        return redirect()->route('admin.comments.index');
    }
}
