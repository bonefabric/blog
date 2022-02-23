<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoryNotesTable extends Migration
{
    /**
     * @return void
     */
    public function up(): void
    {
        Schema::create('history_notes', function (Blueprint $table) {
            $table->id();
            $table->string('note');
            $table->foreignId('user_id')->nullable()->constrained();
            $table->timestamps();
        });
    }

    /**
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('history_notes');
    }
}
