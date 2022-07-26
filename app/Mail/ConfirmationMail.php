<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $name = null;
    public $surname = null;
    public $restaurant_name = null;
    public $delivery_time = null;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($passed_name, $passed_surname, $passed_restaurant_name, $passed_delivery_time)
    {
        $this->name = $passed_name;
        $this->surname = $passed_surname;
        $this->restaurant_name = $passed_restaurant_name;
        $this->delivery_time = $passed_delivery_time;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('admin.mail.ConfirmationMail');
    }
}
