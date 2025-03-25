<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DoctorNotification extends Notification
{
    use Queueable;

    protected $appDate;
    protected $sessionNo;
    protected $name;
    protected $patientId;

    /**
     * Create a new notification instance.
     */
    public function __construct($appDate, $sessionNo, $name, $patientId)
    {
        $this->appDate = $appDate;
        $this->sessionNo = $sessionNo;
        $this->name = $name;
        $this->patientId = $patientId;
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via($notifiable)
    {
        return ['database']; // You can add 'mail', 'sms', etc.
    }

    /**
     * Get the array representation of the notification.
     */
    public function toArray($notifiable)
    {
        return [
            'app_date' => $this->appDate,
            'session_no' => $this->sessionNo,
            'name' => $this->name,
            'patient_id' => $this->patientId,
        ];
    }
}
