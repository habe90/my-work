<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuccessfulJob;
use App\Models\Invoice;
use Auth;
use Carbon\Carbon; 
use PDF;
use Illuminate\Support\Facades\Log;
use Exception;


class InvoiceController extends Controller
{

    public function index(){
        return view('admin.invoice.index');
    }


    public function generateInvoices()
    {
        try {
            // Dohvatanje svih uspješnih poslova koji nisu fakturisani i grupisanje po kompaniji
            $successfulJobs = SuccessfulJob::where('invoiced', 0)
                ->whereMonth('completion_date', '=', Carbon::now()->month)
                ->with('bid') 
                ->get()
                ->groupBy(function ($job) {
                    return $job->bid->user_id ?? null;
                });
    
            foreach ($successfulJobs as $company_id => $jobs) {
                // Preskoči iteraciju ako grupa nema poslove ili ako company_id nije definisan
                if (empty($jobs) || is_null($company_id)) continue;
    
                $totalAmountDue = $jobs->sum('amount_due'); // Izračunaj ukupan iznos
    
                // Kreiraj fakturu za kompaniju
                $invoice = new Invoice();
                $invoice->company_id = $company_id;
                $invoice->amount = $totalAmountDue;
                $invoice->invoice_date = now();
                $invoice->due_date = now()->addDays(30); // Postavi rok plaćanja
                $invoice->status = 'unpaid';
                $invoice->save();
    
                // Ažuriraj sve uspješne poslove kao fakturisane
                foreach ($jobs as $job) {
                    $job->invoiced = 1;
                    $job->invoice_id = $invoice->id; 
                    $job->save();
                }
            }
        } catch (Exception $e) {
            // Logovanje izuzetka
            Log::error("Greška pri generisanju fakture: " . $e->getMessage());
            Log::error($e->getTraceAsString()); // Dodatni detalji izuzetka
         
        }
    }
    

    

    public function showInvoices($id)
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
