<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Order;
use App\Item;

class AdminMail extends Mailable
{
    use Queueable, SerializesModels;

    public $name = null;
    public $surname = null;
    public $amount = null;
    public $order = null;
    public $transaction_id = null;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($passed_name, $passed_surname, $passed_amount, $passed_itemsOrdered, $passed_result)
    {
        $this->name = $passed_name;
        $this->surname = $passed_surname;
        $this->amount = $passed_amount;
        $this->order = $passed_itemsOrdered;
        $this->transaction_id = $passed_result;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('admin.mail.AdminMail');
    }
}
