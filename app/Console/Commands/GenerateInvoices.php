<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\InvoiceController;

class GenerateInvoices extends Command
{
    protected $signature = 'invoices:generate';
    protected $description = 'Generate invoices for all companies';

    public function handle()
    {
        app(InvoiceController::class)->generateInvoices();
        $this->info('Invoices have been generated successfully.');
    }
}
