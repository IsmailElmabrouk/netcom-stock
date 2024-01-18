<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RejectionJustificationNotification extends Notification
{
    use Queueable;
    protected $bonSortie;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
        $this->bonSortie = $bonSortie;

    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toDatabase($notifiable)
    {
        // Store the notification in the database
        return [
            'bon_sortie_id' => $this->bonSortie->id,
            // Add other data you want to store in the database
        ];
    }
    public function toArray($notifiable)
    {
 
            return ['database']; // Use the database channel

       
    }
}
