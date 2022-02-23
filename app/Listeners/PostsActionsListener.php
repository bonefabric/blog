<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Events\Posts\PostCreated;
use App\Events\Posts\PostDeleted;
use App\Events\Posts\PostRestored;
use App\Events\Posts\PostTrashed;
use App\Events\Posts\PostUpdated;
use App\Repositories\HistoryNoteRepository;

class PostsActionsListener
{

    /**
     * @var HistoryNoteRepository
     */
    private $historyNoteRepository;

    /**
     * @return void
     */
    public function __construct(HistoryNoteRepository $historyNoteRepository)
    {
        $this->historyNoteRepository = $historyNoteRepository;
    }

    /**
     * @param PostCreated $event
     * @return void
     */
    public function postCreated(PostCreated $event): void
    {
        $this->historyNoteRepository->createNote('Post created. ID: ' . $event->getPost()->id);
    }

    /**
     * @param PostDeleted $event
     * @return void
     */
    public function postDeleted(PostDeleted $event): void
    {
        $this->historyNoteRepository->createNote('Post deleted. ID: ' . $event->getPost()->id);
    }

    /**
     * @param PostRestored $event
     * @return void
     */
    public function postRestored(PostRestored $event): void
    {
        $this->historyNoteRepository->createNote('Post restored. ID: ' . $event->getPost()->id);
    }

    /**
     * @param PostTrashed $event
     * @return void
     */
    public function postTrashed(PostTrashed $event): void
    {
        $this->historyNoteRepository->createNote('Post trashed. ID: ' . $event->getPost()->id);
    }

    /**
     * @param PostUpdated $event
     * @return void
     */
    public function postUpdated(PostUpdated $event): void
    {
        $this->historyNoteRepository->createNote('Post updated. ID: ' . $event->getPost()->id);
    }
}
