<?php

declare(strict_types=1);

namespace App\Providers;

use App\Events\UserBanned;
use App\Events\UserUnbanned;
use App\Listeners\WriteAdminHistory;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use phpDocumentor\Reflection\Types\ClassString;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<ClassString, array<int, ClassString>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        UserBanned::class => [
            [WriteAdminHistory::class, 'userBanned'],
        ],
        UserUnbanned::class => [
            [WriteAdminHistory::class, 'userUnbanned'],
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot(): void
    {

    }
}
