<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Events\Tags\TagCreated;
use App\Events\Tags\TagDeleted;
use App\Events\Tags\TagRestored;
use App\Events\Tags\TagTrashed;
use App\Events\Tags\TagUpdated;
use App\Repositories\HistoryRepository;

class TagsActionsListener
{

    /**
     * @var HistoryRepository
     */
    private $historyNoteRepository;

    /**
     * @return void
     */
    public function __construct(HistoryRepository $historyNoteRepository)
    {
        $this->historyNoteRepository = $historyNoteRepository;
    }

    /**
     * @param TagCreated $event
     * @return void
     */
    public function tagCreated(TagCreated $event): void
    {
        $this->historyNoteRepository->createNote('Tag created. ID: ' . $event->getTag()->id);
    }

    /**
     * @param TagDeleted $event
     * @return void
     */
    public function tagDeleted(TagDeleted $event): void
    {
        $this->historyNoteRepository->createNote('Tag deleted. ID: ' . $event->getTag()->id);
    }

    /**
     * @param TagRestored $event
     * @return void
     */
    public function tagRestored(TagRestored $event): void
    {
        $this->historyNoteRepository->createNote('Tag restored. ID: ' . $event->getTag()->id);
    }

    /**
     * @param TagTrashed $event
     * @return void
     */
    public function tagTrashed(TagTrashed $event): void
    {
        $this->historyNoteRepository->createNote('Tag trashed. ID: ' . $event->getTag()->id);
    }

    /**
     * @param TagUpdated $event
     * @return void
     */
    public function tagUpdated(TagUpdated $event): void
    {
        $this->historyNoteRepository->createNote('Tag updated. ID: ' . $event->getTag()->id);
    }
}
