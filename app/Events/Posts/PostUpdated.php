<?php

declare(strict_types=1);

namespace App\Events\Posts;

use App\Models\Post;
use Illuminate\Foundation\Events\Dispatchable;

class PostUpdated
{
    use Dispatchable;

    /**
     * @var Post
     */
    private $post;

    /**
     * @return void
     */
    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    /**
     * @return Post
     */
    public function getPost(): Post
    {
        return $this->post;
    }
}
