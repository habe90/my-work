<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuccessfulJob;
use App\Models\Invoice;
use Auth;
use Carbon\Carbon; 
use PDF;

class InvoiceController extends Controller
{

    public function index(){
        return view('admin.invoice.index');
    }


    public function generateInvoices()
    {
        // Dohvati sve uspješne poslove koji nisu fakturisani
        $successfulJobs = SuccessfulJob::where('invoiced', 0)
            ->whereMonth('completion_date', '=', Carbon::now()->month)
            ->get();

        // Grupiši poslove po user_id iz bids tabele
        $groupedJobs = $successfulJobs->mapToGroups(function ($job, $key) {
            return [$job->bid->user_id => $job];
        });

        foreach ($groupedJobs as $company_id => $jobs) {
            // Izračunaj ukupan iznos za fakturisanje
            $totalAmountDue = $jobs->sum('amount_due');

            // Kreiraj fakturu za kompaniju
            $invoice = new Invoice();
            $invoice->company_id = $company_id; // ovdje koristimo user_id iz bids tabele
            $invoice->amount = $totalAmountDue;
            $invoice->invoice_date = now();
            $invoice->due_date = now()->addDays(30);
            $invoice->status = 'unpaid';
            $invoice->save();

            // Ažuriraj svaki posao kao fakturisan
            SuccessfulJob::whereIn('id', $jobs->pluck('id'))->update(['invoiced' => 1]);
        }
    }

    

    public function showInvoices()
    {
        $invoices = Invoice::with('company')
            ->where('company_id', Auth::id())
            ->get();

        return view('frontend.invoices.show', compact('invoices'));
    }

   public function downloadInvoice($invoiceId)
    {
        $invoice = Invoice::with(['company', 'successfulJobs.offer'])
                        ->findOrFail($invoiceId);

        // Generisanje PDF-a iz view-a 'invoice.blade.php'
        $pdf = PDF::loadView('invoice', ['invoice' => $invoice]);

        // Definisanje imena fajla za preuzimanje
        $fileName = 'faktura-' . $invoice->id . '.pdf';

        // Preuzimanje PDF-a
        return $pdf->download($fileName);
}
}
