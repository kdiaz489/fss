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
        $this->path = base_path('public/temp/freightbill.pdf');
        $this->pdf = PDF::loadView('pdf.invoice',  ['shipment' => $shipment])->setPaper('a4')->setTimeout(3600);
       // $this->pdf->save('freightbill.pdf');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.contact.ship-booking-email')->subject('Shipment Request Submitted');
    }
}
