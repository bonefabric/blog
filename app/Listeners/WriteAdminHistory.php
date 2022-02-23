<?php

declare(strict_types=1);

namespace App\Listeners;

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
    }
}
