<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use PDF;
use App\Shipment;
use File;

class ShipmentBookingMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($filePath, $shipment)
    {
        //$shipment = Shipment::find($id);
        $this->filePath = $filePath;
        $this->data = $shipment;
       
    
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.contact.ship-booking-email')->subject('Shipment Request Submitted')->attach($this->filePath);
    }
}
