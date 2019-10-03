<?php

namespace App\Http\Controllers;
use App\Shipment;
use PDF;
use Illuminate\Http\Request;

class PDFController extends Controller
{
    public function index(){
        $shipment = Shipment::find(19);
        //dd($shipment->user_id);
        $pdf = PDF::loadView('pdf.invoice', ['shipment' => $shipment]);
        $fileName = 'testpdf';
        //return $pdf->stream('document.pdf');
        return view('pdf.invoice')->with('shipment', $shipment);
    }
}
