<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Order;
use App\Item;


class PaymentMail extends Mailable
{
    use Queueable, SerializesModels;
    
    public $name = null;
    public $surname = null;
    public $amount = null;
    public $order = null;
    public $transaction_id = null;
    // public $obj = [];

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($passed_name, $passed_surname, $passed_amount, $passed_itemsOrdered, $passed_result)
    {
        // dd($passed_customer, $passed_newOrder, $passed_itemOrdered, $passed_result);
        $this->name = $passed_name;
        $this->surname = $passed_surname;
        $this->amount = $passed_amount;
        $this->order = $passed_itemsOrdered;
        $this->transaction_id = $passed_result;

        // $this->obj = [
        //     [
        //         "order" => $passed_itemsOrdered
        //     ],
        //     [
        //         "name" => $passed_customer->name
        //     ],
        //     [
        //         "surname" => $passed_customer->surname
        //     ],
        //     [
        //         "transaction_id" => $passed_result->data->transaction->id
        //     ],
        //     [
        //         "amount" => $passed_amount
        //     ]
        // ];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // return $this->view('admin.mail.PaymentMail', compact($this->name, $this->surname, $this->amount, $this->order, $this->transaction_id));
        // return $this->view('admin.mail.PaymentMail', compact($this->obj));
        return $this->view('admin.mail.PaymentMail');
    }
}
