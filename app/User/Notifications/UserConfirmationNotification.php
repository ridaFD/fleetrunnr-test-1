<?php

namespace App\User\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Crypt;

class UserConfirmationNotification extends Notification
{
    use Queueable;

    /**
     * @var string
     */
    public $user;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user = null)
    {
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $phone = $this->user->phone;
        $user_id = $this->user->id;
        $email = $this->user->email;
        $data = $phone. ',' . $user_id . ',' . $email;

        $token = Crypt::encryptString($data);

        return (new MailMessage)
            ->from('fleetrunnr@gmail.com')
            ->markdown('mail.users.user-confirmation', [
                'name' => $this->user->name,
                'token' => $token
            ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
