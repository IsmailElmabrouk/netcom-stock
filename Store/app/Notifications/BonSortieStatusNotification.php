<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class BonSortieStatusNotification extends Notification
{
    public $bonSortie;
    public $status;

    public function __construct($bonSortie, $status)
    {
        $this->bonSortie = $bonSortie;
        $this->status = $status;
    }

// BonSortieStatusNotification.php

public function toDatabase($notifiable)
{
    $data = [
        'bon_sortie_id' => $this->bonSortie->id,
        'status' => $this->status,
        'reject_justification' => $this->bonSortie->reject_justification ?? null, // Include justification if available
    ];

    if ($this->status == 'pending_verification') {
        $data['message'] = 'Bon de Sortie requires verification. Please check and verify.';
    } else {
        // Adjust messages for acceptance and rejection
        $data['message'] = 'Bon de Sortie ' . ($this->status == 'accepted' ? 'accepted' : 'rejected') . ' successfully.';
    }

    return $data;
}


    // Add the via method to specify the notification channels
    public function via($notifiable)
    {
        return ['database']; // Use the database channel
    }
}
