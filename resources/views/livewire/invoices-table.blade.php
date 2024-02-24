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
                    <td>
                        <div class="flex items-center font-semibold">
                            <div class="p-0.5 bg-white-dark/30 rounded-full w-max ltr:mr-2 rtl:ml-2">
                                <img class="h-8 w-8 rounded-full object-cover" src="{{asset('assets/images/profile-5.jpeg')}}">
                            </div>
                            {{ $invoice->company->name }}
                        </div>
                    </td>
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
