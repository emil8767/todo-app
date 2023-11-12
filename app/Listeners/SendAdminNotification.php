<?php

namespace App\Listeners;

use App\Events\NoteCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\NoteMail;
use App\Mail\NoteCreatedMail;

class SendAdminNotification implements ShouldQueue
{
    use InteractsWithQueue;
    public function __construct(NoteCreated $event)
    {
    }

    /**
     * Handle the event.
     */
    public function handle(NoteCreated $event): void
    {
        $email = $event->email;
        $name = $event->name;
        Mail::to('testreceiver@gmail.com’')->send(new NoteMail($email, $name));
    }
}
