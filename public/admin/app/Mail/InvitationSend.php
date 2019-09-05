<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Invitation;
use Illuminate\Notifications\Messages\MailMessage;

class InvitationSend extends Mailable
{
    public $invitation;

    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Invitation $invitation)
    {
        $this->invitation = $invitation;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // $accept = url(route('invitations.send', [$this->invitation->id, 'accept']));
        // $reject = url(route('invitations.send', [$this->invitation->id, 'reject']));
        // return $this->view(new MailMessage)
        //             ->subject('APUSUOF | New Upcoming Event!')
        //             ->line(' Event: ' .$this->invitation->event->name)
        //             ->line('Are You Joining Event?')
        //             ->action('Accept', $accept)
        //             ->action('Reject', $reject)
        //             ->line('Thank you for using our System!');
        return $this->view('emails.invitation');
    }
}
