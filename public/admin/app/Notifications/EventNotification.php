<?php

namespace App\Notifications;

use App\Invitation;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class EventNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $invitation;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Invitation $invitation)
    {
        $this->invitation = $invitation;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $accept = url(route('invitations.send', [$this->invitation->id, 'join']));
        $reject = url(route('invitations.send', [$this->invitation->id, 'declin']));
        return (new MailMessage)
                    ->subject('APUSUOF | New Upcoming Event!')
                    ->line(' Event: ' .$this->invitation->event->name)
                    ->line('Are You Joining Event?')
                    ->action('Join', $accept)
                    ->action2('Decline', $reject)
                    ->line('Thank you for using our System!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return[
            'invitation'=>$this->invitation,
            'event'=>$this->invitation->event
        ];
    }
}
