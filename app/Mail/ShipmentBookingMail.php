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
    public function __construct($data, $id)
    {
        $shipment = Shipment::find($id);
        $this->data = $data;
        
	    
        $filename = 'invoice';
        $this->path = "/temp";

        if(!File::exists($this->path)) {
            File::makeDirectory($this->path, $mode = 0755, true, true);

        } 
        else {}

        $this->pdf = PDF::loadView('pdf.invoice',  ['shipment' => $shipment])->setPaper('a4')->save(''.$this->path.'/'.$filename.'.pdf');
        //$pdf = PDF::loadView('pdf.orderConfirmationPdf', $data)->save(''.$this->path.'/'.$filename.'.pdf');
        

        //return $pdf->download(''.$filename.'.pdf');  
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
