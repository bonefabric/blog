<?php

declare(strict_types=1);

namespace App\Events\Tags;

use App\Models\Tag;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TagUpdated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var Tag
     */
    private $tag;

    /**
     * @return void
     */
    public function __construct(Tag $tag)
    {
        $this->tag = $tag;
    }

    /**
     * @return Tag
     */
    public function getTag(): Tag
    {
        return $this->tag;
    }
}
