<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\HistoryNote;
use Illuminate\Support\Facades\Auth;

class HistoryNoteRepository
{

    /**
     * @param string $note
     * @return void
     */
    public function createNote(string $note): void
    {
        if (!Auth::check()) {
            return;
        }
        $historyNote = HistoryNote::make(['note' => $note]);
        $historyNote->user_id = Auth::user()->id;
        $historyNote->save();
    }
}
