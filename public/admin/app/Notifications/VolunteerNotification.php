<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Volunteer;

class VolunteerNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $volunteer;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Volunteer $volunteer)
    {
        $this->volunteer = $volunteer;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $event = 'http://apusuof.me/volunteering/'.$this->volunteer->event->id;
        return (new MailMessage)
                    ->subject('APUSUOF | Volunteer Request Approved!')
                    ->line(' Event: ' .$this->volunteer->event->name)
                    ->line('Your Volunteering Request Successfully Approved!')
                    ->action('See Event', $event)
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
            'event'=>$this->volunteer->event
        ];
    }
}
