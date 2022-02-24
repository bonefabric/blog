<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Events\Comments\CommentCreated;
use App\Events\Comments\CommentDeleted;
use App\Events\Comments\CommentRestored;
use App\Events\Comments\CommentReviewed;
use App\Events\Comments\CommentTrashed;
use App\Events\Posts\PostCreated;
use App\Events\Posts\PostDeleted;
use App\Events\Posts\PostRestored;
use App\Events\Posts\PostTrashed;
use App\Events\Posts\PostUpdated;
use App\Events\Tags\TagCreated;
use App\Events\Tags\TagDeleted;
use App\Events\Tags\TagRestored;
use App\Events\Tags\TagTrashed;
use App\Events\Tags\TagUpdated;
use App\Events\User\UserBanned;
use App\Events\User\UserRegistered;
use App\Events\User\UserUnbanned;
use Illuminate\Events\Dispatcher;

class WriteAdminHistory
{

    /**
     * @param Dispatcher $dispatcher
     * @return void
     */
    public function subscribe(Dispatcher $dispatcher): void
    {
        $dispatcher->listen(
            UserBanned::class,
            [UserActionsListener::class, 'userBanned']
        );
        $dispatcher->listen(
            UserUnbanned::class,
            [UserActionsListener::class, 'userUnbanned']
        );
        $dispatcher->listen(
            UserRegistered::class,
            [UserActionsListener::class, 'userRegistered']
        );

        $dispatcher->listen(
            TagCreated::class,
            [TagsActionsListener::class, 'tagCreated']
        );
        $dispatcher->listen(
            TagDeleted::class,
            [TagsActionsListener::class, 'tagDeleted']
        );
        $dispatcher->listen(
            TagRestored::class,
            [TagsActionsListener::class, 'tagRestored']
        );
        $dispatcher->listen(
            TagTrashed::class,
            [TagsActionsListener::class, 'tagTrashed']
        );
        $dispatcher->listen(
            TagUpdated::class,
            [TagsActionsListener::class, 'tagUpdated']
        );

        $dispatcher->listen(
            PostCreated::class,
            [PostsActionsListener::class, 'postCreated']
        );
        $dispatcher->listen(
            PostDeleted::class,
            [PostsActionsListener::class, 'postDeleted']
        );
        $dispatcher->listen(
            PostRestored::class,
            [PostsActionsListener::class, 'postRestored']
        );
        $dispatcher->listen(
            PostTrashed::class,
            [PostsActionsListener::class, 'postTrashed']
        );
        $dispatcher->listen(
            PostUpdated::class,
            [PostsActionsListener::class, 'postUpdated']
        );

        $dispatcher->listen(
            CommentCreated::class,
            [CommentsActionsListener::class, 'commentCreated']
        );
        $dispatcher->listen(
            CommentDeleted::class,
            [CommentsActionsListener::class, 'commentDeleted']
        );
        $dispatcher->listen(
            CommentRestored::class,
            [CommentsActionsListener::class, 'commentRestored']
        );
        $dispatcher->listen(
            CommentReviewed::class,
            [CommentsActionsListener::class, 'commentReviewed']
        );
        $dispatcher->listen(
            CommentTrashed::class,
            [CommentsActionsListener::class, 'commentTrashed']
        );
    }
}
