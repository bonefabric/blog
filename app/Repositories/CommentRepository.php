<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Events\Comments\CommentCreated;
use App\Events\Comments\CommentReviewed;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentRepository
{

    /**
     * @param Request $request
     * @param string $commentable
     * @param int $commentableId
     * @return Comment
     */
    public function createByRequest(Request $request, string $commentable, int $commentableId): Comment
    {
        if (!Auth::check()) {
            abort(403);
        }
        $request->validate([
            'comment' => ['required']
        ]);

        $comment = new Comment(['comment' => $request->input('comment')]);
        $comment->user_id = Auth::id();
        $commentable::findOrFail($commentableId)->comments()->save($comment);
        CommentCreated::dispatch($comment);
        return $comment;
    }

    /**
     * @param int $id
     * @return void
     */
    public function review(int $id): void
    {
        if (!Auth::check()) {
            abort(403);
        }
        $comment = Comment::withoutGlobalScope('reviewed')->findOrFail($id);
        $comment->reviewed = true;
        $comment->reviewer_id = Auth::id();
        $comment->save();
        CommentReviewed::dispatch($comment);
    }
}
