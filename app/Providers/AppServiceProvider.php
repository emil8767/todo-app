<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Events\NoteCreated;
use Illuminate\Support\Facades\Event;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(NoteCreated::class, function () {
            return new NoteCreated(true, true);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Event::listen('NoteCreated', function ($eventData) {
            // Ваш код для обработки события
        });
    }
}
