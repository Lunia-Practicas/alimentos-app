<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{

    protected $listen = [
        'App\Events\OrderCreated' => [
            'App\Listeners\SendOrderEmail'
        ],
        'App\Events\EmailCreated' => [
            'App\Listeners\CreateClientEmail'
        ]
    ];

    public function boot(): void
    {
        //
    }

    public function shouldDiscoverEvents(): bool
    {
        return false;
    }

}
