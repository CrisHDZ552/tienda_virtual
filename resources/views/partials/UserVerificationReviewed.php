<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class UserVerificationReviewed extends Notification
{
    use Queueable;

    public $status;

    public function __construct($status)
    {
        $this->status = $status;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        $estado = $this->status == 1 ? 'Aceptada' : 'Rechazada';
        return [
            'message' => 'Tu solicitud de verificación ha sido ' . $estado . '.',
            'url' => '/perfil'
        ];
    }
}