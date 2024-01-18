<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BonSortieVerificationNotification extends Notification
{
    use Queueable;

    private $bonSortie;

    public function __construct($bonSortie)
    {
        $this->bonSortie = $bonSortie;
    }

    public function toDatabase($notifiable)
    {
        // Store the notification in the database
        return [
            'bon_sortie_id' => $this->bonSortie->id,
            // Add other data you want to store in the database
        ];
    }
    public function via($notifiable)
    {
        return ['database'];
        // Add other channels if needed, like 'broadcast', 'nexmo', etc.
    }
}
