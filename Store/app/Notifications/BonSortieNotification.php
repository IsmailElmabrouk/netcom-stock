<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class BonSortieNotification extends Notification
{
    protected $bonSortie;
    protected $status;

    public function __construct($bonSortie, $status)
    {
        $this->bonSortie = $bonSortie;
        $this->status = $status;
    }

    public function toDatabase($notifiable)
    {
        return [
            'bonSortieId' => $this->bonSortie->id,
            'status' => $this->status == 1 ? 'accepted' : 'rejected',
        ];
    }

    // Define the "via" method to specify the channels
    public function via($notifiable)
    {
        return ['database']; // This assumes you want to store notifications in the database
    }
}
