<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne as HasOneAlias;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'comment',
    ];

    /**
     * @return HasOneAlias
     */
    public function user(): HasOneAlias
    {
        return $this->hasOne(User::class);
    }

    /**
     * @return MorphTo
     */
    public function commentable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * @return void
     */
    public function comments(): void
    {
        $this->morphMany(__CLASS__, 'commentable');
    }

}
