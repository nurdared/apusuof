<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notifiable;

class RepliedToThread extends Notification
{
    use Queueable;

    protected $thread, $comment;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($thread, $comment)
    {
        $this->thread=$thread;
        $this->comment=$comment;
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
        $url =url('/forum/thread/'.$this->thread->id);
        return (new MailMessage)
                    ->subject('APUSUOF | New Replied Message to your Thread')
                    ->line(auth()->user()->name.' Replied to: ' .$this->thread->subject)
                    ->line($this->comment->body)
                    ->action('APU SUOF', $url)
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
            'thread'=>$this->thread,
            'user'=>auth()->user()
        ];
    }

}
