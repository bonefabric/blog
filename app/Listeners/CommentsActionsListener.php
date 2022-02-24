<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Events\Comments\CommentCreated;
use App\Events\Comments\CommentDeleted;
use App\Events\Comments\CommentRestored;
use App\Events\Comments\CommentReviewed;
use App\Events\Comments\CommentTrashed;
use App\Repositories\HistoryRepository;

class CommentsActionsListener
{

    /**
     * @var HistoryRepository
     */
    private $historyRepository;

    /**
     * @param HistoryRepository $historyRepository
     */
    public function __construct(HistoryRepository $historyRepository)
    {
        $this->historyRepository = $historyRepository;
    }

    /**
     * @param CommentCreated $event
     * @return void
     */
    public function commentCreated(CommentCreated $event): void
    {
        $this->historyRepository->createNote('Comment created. ID: ' . $event->getComment()->id);
    }

    /**
     * @param CommentDeleted $event
     * @return void
     */
    public function commentDeleted(CommentDeleted $event): void
    {
        $this->historyRepository->createNote('Comment deleted. ID: ' . $event->getComment()->id);
    }

    /**
     * @param CommentRestored $event
     * @return void
     */
    public function commentRestored(CommentRestored $event): void
    {
        $this->historyRepository->createNote('Comment restored. ID: ' . $event->getComment()->id);
    }

    /**
     * @param CommentReviewed $event
     * @return void
     */
    public function commentReviewed(CommentReviewed $event): void
    {
        $this->historyRepository->createNote('Comment reviewed. ID: ' . $event->getComment()->id);
    }

    /**
     * @param CommentTrashed $event
     * @return void
     */
    public function commentTrashed(CommentTrashed $event): void
    {
        $this->historyRepository->createNote('Comment trashed. ID: ' . $event->getComment()->id);
    }
}
