<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Events\UserBanned;
use App\Events\UserUnbanned;
use App\Repositories\HistoryNoteRepository;
use Illuminate\Events\Dispatcher;

class WriteAdminHistory
{

    /**
     * @var HistoryNoteRepository
     */
    private $historyNoteRepository;

    public function __construct(HistoryNoteRepository $historyNoteRepository)
    {
        $this->historyNoteRepository = $historyNoteRepository;
    }

    /**
     * @param UserBanned $event
     * @return void
     */
    public function userBanned(UserBanned $event): void
    {
        $this->historyNoteRepository->createNote('User banned. ID: ' . $event->getUser()->id .
            ', name: ' . $event->getUser()->getAttribute('name') .
            ', email: ' . $event->getUser()->getAttribute('email'));
    }

    /**
     * @param UserUnbanned $event
     * @return void
     */
    public function userUnbanned(UserUnbanned $event): void
    {
        $this->historyNoteRepository->createNote('User unbanned. ID: ' . $event->getUser()->id .
            ', name: ' . $event->getUser()->getAttribute('name') .
            ', email: ' . $event->getUser()->getAttribute('email'));
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
