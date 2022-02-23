<?php

declare(strict_types=1);

namespace App\Listeners;

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
    }
}
