<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use phpDocumentor\Reflection\Types\Null_;

class StorUpdateMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if(($this->data->order_type == 'Fulfill Items') && ($this->data->cust_order_no != null)){
            return $this->markdown('emails.contact.stor-update-email')->from('ship@fillstorship.com')->subject('Order #' . $this->data->cust_order_no . ' is now ' . $this->data->status);
        }
        elseif(($this->data->order_type == 'Fulfill Items') && ($this->data->cust_order_no == null)){
            return $this->markdown('emails.contact.stor-update-email')->from('ship@fillstorship.com')->subject('Order #' . $this->data->orderid . ' is now ' . $this->data->status);
        }
        else{
            return $this->markdown('emails.contact.stor-update-email')->from('ship@fillstorship.com')->subject('Order #' . $this->data->orderid . ' is now ' . $this->data->status);
        }
    }
}
