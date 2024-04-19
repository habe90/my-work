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
    // Pretpostavimo da je relacija između SuccessfulJob i Bid definirana kao 'bid'
    $successfulJobs = SuccessfulJob::where('invoiced', 0)
        ->whereMonth('completion_date', '=', Carbon::now()->month)
        ->with('bid') // Učitaj relaciju 'bid'
        ->get();

    // Grupiši poslove po user_id iz bids tabele
    $groupedJobs = $successfulJobs->mapToGroups(function ($job, $key) {
        // Provjeri da li postoji povezani bid prije pokušaja čitanja user_id
        if (!is_null($job->bid)) {
            return [$job->bid->user_id => $job];
        } else {
            // Loguj ili obradi slučaj kada bid nije pronađen
            Log::warning("SuccessfulJob sa ID {$job->id} nema povezan bid.");
            return [];
        }
    });

    foreach ($groupedJobs as $company_id => $jobs) {
        // Ako nema poslova, preskoči ovu iteraciju
        if (empty($jobs)) continue;

        // Izračunaj ukupan iznos za fakturisanje
        $totalAmountDue = $jobs->sum('amount_due');

        // Ostatak koda za kreiranje fakture...
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
