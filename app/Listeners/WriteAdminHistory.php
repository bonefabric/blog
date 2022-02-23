<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Events\UserBanned;
use App\Events\UserRegistered;
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
        $dispatcher->listen(
            UserRegistered::class,
            [__CLASS__, 'userRegistered']
        );
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
     * @param userRegistered $event
     * @return void
     */
    public function userRegistered(userRegistered $event): void
    {
        $this->historyNoteRepository->createNote('User registered. ID: ' . $event->getUser()->id .
            ', name: ' . $event->getUser()->getAttribute('name') .
            ', email: ' . $event->getUser()->getAttribute('email'));
    }
}
