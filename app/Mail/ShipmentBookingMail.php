<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use PDF;
use App\Shipment;

class ShipmentBookingMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data, $id)
    {
        $shipment = Shipment::find($id);
        $this->data = $data;
        //$this->pdf_data = $pdf_data;
        $this->path = 'public/temp/freightbill.pdf';
        $this->pdf = PDF::loadView('pdf.invoice',  ['shipment' => $shipment])->save($this->path);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.contact.ship-booking-email')->subject('Shipment Request Submitted')->attach($this->path, [
                            'as' => 'freightbill.pdf', 
                            'mime' => 'application/pdf',
                    ]);
    }
}
