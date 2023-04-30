<?php

namespace App\Listeners;

use App\Events\NewNotificationEvent;
use App\Models\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendNotificationListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param NewNotificationEvent $event
     * @return void
     */
    public function handle(NewNotificationEvent $event)
    {
        $notification = new Notification();
        $notification->type = 'App\Notifications\NewNotification';
        $notification->notifiable_type = get_class($event->user);
        $notification->notifiable_id = $event->user->id;
        $notification->message = $event->message;
        $notification->save();
    }
}
