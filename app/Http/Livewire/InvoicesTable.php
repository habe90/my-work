<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Invoice;
use Livewire\WithPagination;

class InvoicesTable extends Component
{
    use WithPagination;

    public function render()
    {
        $invoices = Invoice::latest()->paginate(10);
        return view('livewire.invoices-table', compact('invoices'));
    }
}
