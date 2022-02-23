<?php

declare(strict_types=1);

namespace App\Repositories;

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
        return $comment;
    }
}
