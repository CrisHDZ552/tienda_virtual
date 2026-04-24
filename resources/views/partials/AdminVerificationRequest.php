<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class AdminVerificationRequest extends Notification
{
    use Queueable;

    public $userRequestName;

    public function __construct($userRequestName)
    {
        $this->userRequestName = $userRequestName;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => 'Nueva solicitud de verificación pendiente de: ' . $this->userRequestName,
            'url' => '/verificar_solicitud'
        ];
    }
}