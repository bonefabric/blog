<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Events\User\UserBanned;
use App\Events\User\UserRegistered;
use App\Events\User\UserUnbanned;
use App\Repositories\HistoryRepository;

class UserActionsListener
{

    /**
     * @var HistoryRepository
     */
    private $historyNoteRepository;

    public function __construct(HistoryRepository $historyNoteRepository)
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
     * @param UserRegistered $event
     * @return void
     */
    public function userRegistered(UserRegistered $event): void
    {
        $this->historyNoteRepository->createNote('User registered. ID: ' . $event->getUser()->id .
            ', name: ' . $event->getUser()->getAttribute('name') .
            ', email: ' . $event->getUser()->getAttribute('email'));
    }
}
