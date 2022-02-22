<?php

declare(strict_types=1);

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\ClassString;

class CommentsController extends Controller
{

    /**
     * @var array<string, ClassString>
     */
    protected $commentable = [
        'post' => Post::class,
        'comment' => Comment::class,
    ];

    /**
     * @param string $source
     * @param int $id
     * @return Application|Factory|View
     */
    public function index(string $source, int $id)
    {
        $this->validateSource($source);

        return view('comments.index')
            ->with('comments', $this->commentable[$source]::findOrFail($id)->comments)
            ->with('source', $source);
    }

    /**
     * @param string $source
     * @param int $id
     * @return Application|Factory|View
     */
    public function create(string $source, int $id)
    {
        $this->validateSource($source);
        return view('comments.create')
            ->with(['source' => $source, 'id' => $id]);
    }

    public function store(string $source, int $id, Request $request)
    {
        $this->validateSource($source);
        $request->validate([
            'comment' => ['required']
        ]);
        $comment = new Comment();

        //TODO change method
        $comment->user_id = Auth::id();
        $comment->comment = $request->input('comment');
        $this->commentable[$source]::findOrFail($id)->comments()->save($comment);
        $comment->save();
        return redirect(route('blog.comments', [$source, $id]));
    }

    /**
     * @param string $source
     * @return void
     */
    private function validateSource(string $source): void
    {
        if (!array_key_exists($source, $this->commentable) || !method_exists($this->commentable[$source], 'comments')) {
            abort(404);
        }
    }
}
