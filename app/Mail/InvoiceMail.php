<?php

namespace App\Mail;


use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use Barryvdh\DomPDF\Facade\Pdf as PDF; 

class InvoiceMail extends Mailable
{
    use Queueable, SerializesModels;

    public $invoice;

    public function __construct($invoice)
    {
        $this->invoice = $invoice;
    }

    public function build()
    {
        $filePath = $this->generateInvoicePDF($this->invoice); // Générer le PDF

        return $this->subject('Votre Facture Chez Lead And Boost')
                    ->view('invoices.pdf')
                    ->attach($filePath, [
                        'as' => 'facture_' . $this->invoice->id . '.pdf', // Nom du fichier attaché
                        'mime' => 'application/pdf',
                    ])
                    ->with([
                        'invoice' => $this->invoice,
                    ]);
    }

    protected function generateInvoicePDF($invoice)
    {
        $pdf = PDF::loadView('invoices.pdf', compact('invoice'));
        $filePath = storage_path('invoices\invoice_' . $invoice->id . '.pdf');
        $pdf->save($filePath);

        return $filePath;
    }
}
