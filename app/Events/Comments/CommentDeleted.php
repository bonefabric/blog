<?php

declare(strict_types=1);

namespace App\Events\Comments;

use App\Models\Comment;
use Illuminate\Foundation\Events\Dispatchable;

class CommentDeleted
{
    use Dispatchable;

    /**
     * @var Comment
     */
    private $comment;

    /**
     * @return void
     */
    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    /**
     * @return Comment
     */
    public function getComment(): Comment
    {
        return $this->comment;
    }
}
