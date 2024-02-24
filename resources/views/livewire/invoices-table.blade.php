<div>
    <table class="table">
        <thead>
            <tr>
                <th>#Invoice</th>
                <th>Unternehmen</th>
                <th>Betrag</th>
                <th>Rechnungsdatum</th>
                <th>Zahlungsfrist</th>
                <th>Status</th>
                <th>Aktionen</th>
            </tr>
        </thead>
        <tbody>
            @foreach($invoices as $invoice)
                <tr>
                    <td>{{ $invoice->id }}</td>
                    <td>{{ $invoice->company->name }}</td>
                    <td>{{ $invoice->amount }} €</td>
                    <td>{{ $invoice->invoice_date->format('d.m.Y') }}</td>
                    <td>{{ $invoice->due_date->format('d.m.Y') }}</td>
                    <td>
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                            {{ $invoice->status == 'paid' ? 'badge badge-outline-success' : 'badge badge-outline-danger' }}">
                            {{ ucfirst($invoice->status) }}
                        </span>
                    </td>
                    <td>
                        <!-- Ovdje dodajte akcione dugmiće ili linkove -->
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $invoices->links() }}
</div>
