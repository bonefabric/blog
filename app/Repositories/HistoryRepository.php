<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\HistoryNote;
use Illuminate\Support\Facades\Auth;

class HistoryRepository
{

    /**
     * @param string $note
     * @return void
     */
    public function createNote(string $note): void
    {
        $historyNote = HistoryNote::make(['note' => $note]);

        if (Auth::check() && !is_null($user = Auth::user())) {
            $historyNote->user_id = $user->id;
        }
        $historyNote->save();
    }
}
