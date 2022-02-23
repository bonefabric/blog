<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Events\UserBanned;
use App\Events\UserUnbanned;
use App\Models\HistoryNote;
use Illuminate\Events\Dispatcher;
use Illuminate\Support\Facades\Auth;

class WriteAdminHistory
{

    /**
     * @param UserBanned $event
     * @return void
     */
    public function userBanned(UserBanned $event): void
    {
        /** @var HistoryNote $historyNote */
        $historyNote = HistoryNote::make([
            'note' => 'User banned. ID: ' . $event->getUser()->id .
                ', name: ' . $event->getUser()->getAttribute('name') .
                ', email: ' . $event->getUser()->getAttribute('email'),
        ]);
        $historyNote->user_id = Auth::user()->id;
        $historyNote->save();
    }

    /**
     * @param UserUnbanned $event
     * @return void
     */
    public function userUnbanned(UserUnbanned $event): void
    {
        /** @var HistoryNote $historyNote */
        $historyNote = HistoryNote::make([
            'note' => 'User unbanned. ID: ' . $event->getUser()->id .
                ', name: ' . $event->getUser()->getAttribute('name') .
                ', email: ' . $event->getUser()->getAttribute('email'),
        ]);
        $historyNote->user_id = Auth::user()->id;
        $historyNote->save();
    }

    /**
     * @param Dispatcher $dispatcher
     * @return void
     */
    public function subscribe(Dispatcher $dispatcher): void
    {
        $dispatcher->listen(
            UserBanned::class,
            [__CLASS__, 'userBanned']
        );
        $dispatcher->listen(
            UserUnbanned::class,
            [__CLASS__, 'userUnbanned']
        );
    }
}
