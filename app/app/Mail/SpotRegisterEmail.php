<?php

namespace App\Mail;

use App\Packages\User\Domain\Spot\Spot;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SpotRegisterEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $spot;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Spot $spot)
    {
        $this->spot = $spot;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(config('mail.from.address'))
            ->subject(config('mail.subject.register_spot'))
            ->view('mails.registerSpot.to_admin');
    }
}
