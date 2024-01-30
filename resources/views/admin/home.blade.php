@extends('layouts.admin')
@section('content')

<div class="animate__animated p-6" :class="[$store.app.animation]">
    <div x-data="finance">
        <ul class="flex space-x-2 rtl:space-x-reverse">
            <li>
                <a href="javascript:;" class="text-primary hover:underline">Dashboard</a>
            </li>
         
        </ul>
        <div class="pt-5">
            <div class="mb-6 grid grid-cols-1 gap-6 text-white sm:grid-cols-2 xl:grid-cols-4">
                <!-- Users Visit -->
                <div class="panel bg-gradient-to-r from-cyan-500 to-cyan-400">
                    <div class="flex justify-between">
                        <div class="text-md font-semibold ltr:mr-1 rtl:ml-1">{{ $userCountSettings['chart_title'] }}</div>
                        <div x-data="dropdown" @click.outside="open = false" class="dropdown">
                            <a href="javascript:;" @click="toggle">
                                <svg
                                    width="24"
                                    height="24"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5 opacity-70 hover:opacity-80"
                                >
                                    <circle cx="5" cy="12" r="2" stroke="currentColor" stroke-width="1.5" />
                                    <circle opacity="0.5" cx="12" cy="12" r="2" stroke="currentColor" stroke-width="1.5" />
                                    <circle cx="19" cy="12" r="2" stroke="currentColor" stroke-width="1.5" />
                                </svg>
                            </a>
                            <ul
                                x-cloak
                                x-show="open"
                                x-transition
                                x-transition.duration.300ms
                                class="text-black ltr:right-0 rtl:left-0 dark:text-white-dark"
                            >
                                <li><a href="javascript:;" @click="toggle">View Report</a></li>
                                <li><a href="javascript:;" @click="toggle">Edit Report</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="mt-5 flex items-center">
                        <div class="text-3xl font-bold ltr:mr-3 rtl:ml-3">{{ number_format($userCountSettings['total_number']) }}</div>
                        <div class="badge bg-white/30">
                            {{ $userCountSettings['growth_rate'] >= 0 ? '+' : '' }}{{ number_format($userCountSettings['growth_rate'], 2) }}%
                            @if($userCountSettings['growth_rate'] >= 0)
                                (Anstieg im Vergleich zum letzten Monat)
                            @else
                                (Rückgang im Vergleich zum letzten Monat)
                            @endif
                        </div>
                        
                    </div>
                    <div class="mt-5 flex items-center font-semibold">
                        <svg
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5 shrink-0 ltr:mr-2 rtl:ml-2"
                        >
                            <path
                                opacity="0.5"
                                d="M3.27489 15.2957C2.42496 14.1915 2 13.6394 2 12C2 10.3606 2.42496 9.80853 3.27489 8.70433C4.97196 6.49956 7.81811 4 12 4C16.1819 4 19.028 6.49956 20.7251 8.70433C21.575 9.80853 22 10.3606 22 12C22 13.6394 21.575 14.1915 20.7251 15.2957C19.028 17.5004 16.1819 20 12 20C7.81811 20 4.97196 17.5004 3.27489 15.2957Z"
                                stroke="currentColor"
                                stroke-width="1.5"
                            ></path>
                            <path
                                d="M15 12C15 13.6569 13.6569 15 12 15C10.3431 15 9 13.6569 9 12C9 10.3431 10.3431 9 12 9C13.6569 9 15 10.3431 15 12Z"
                                stroke="currentColor"
                                stroke-width="1.5"
                            ></path>
                        </svg>
                        Letzte Woche {{ number_format($userCountSettings['new_last_week']) }}
                    </div>
                </div>

                <!-- Sessions -->
                <div class="panel bg-gradient-to-r from-violet-500 to-violet-400">
                    <div class="flex justify-between">
                        <div class="text-md font-semibold ltr:mr-1 rtl:ml-1">{{ $jobCountSettings['chart_title'] }}</div>
                        <div x-data="dropdown" @click.outside="open = false" class="dropdown">
                            <a href="javascript:;" @click="toggle">
                                <svg
                                    width="24"
                                    height="24"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5 opacity-70 hover:opacity-80"
                                >
                                    <circle cx="5" cy="12" r="2" stroke="currentColor" stroke-width="1.5" />
                                    <circle opacity="0.5" cx="12" cy="12" r="2" stroke="currentColor" stroke-width="1.5" />
                                    <circle cx="19" cy="12" r="2" stroke="currentColor" stroke-width="1.5" />
                                </svg>
                            </a>
                            <ul
                                x-cloak
                                x-show="open"
                                x-transition
                                x-transition.duration.300ms
                                class="text-black ltr:right-0 rtl:left-0 dark:text-white-dark"
                            >
                                <li><a href="javascript:;" @click="toggle">View Report</a></li>
                                <li><a href="javascript:;" @click="toggle">Edit Report</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="mt-5 flex items-center">
                        <div class="text-3xl font-bold ltr:mr-3 rtl:ml-3">{{ number_format($jobCountSettings['total_number']) }}</div>
                   
                    </div>
                    <div class="mt-5 flex items-center font-semibold">
                        <svg
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5 shrink-0 ltr:mr-2 rtl:ml-2"
                        >
                            <path
                                opacity="0.5"
                                d="M3.27489 15.2957C2.42496 14.1915 2 13.6394 2 12C2 10.3606 2.42496 9.80853 3.27489 8.70433C4.97196 6.49956 7.81811 4 12 4C16.1819 4 19.028 6.49956 20.7251 8.70433C21.575 9.80853 22 10.3606 22 12C22 13.6394 21.575 14.1915 20.7251 15.2957C19.028 17.5004 16.1819 20 12 20C7.81811 20 4.97196 17.5004 3.27489 15.2957Z"
                                stroke="currentColor"
                                stroke-width="1.5"
                            ></path>
                            <path
                                d="M15 12C15 13.6569 13.6569 15 12 15C10.3431 15 9 13.6569 9 12C9 10.3431 10.3431 9 12 9C13.6569 9 15 10.3431 15 12Z"
                                stroke="currentColor"
                                stroke-width="1.5"
                            ></path>
                        </svg>
                        Letzte Woche {{ number_format($jobCountSettings['new_last_week']) }}
                    </div>
                </div>

                <!-- Time On-Site -->
                <div class="panel bg-gradient-to-r from-blue-500 to-blue-400">
                    <div class="flex justify-between">
                        <div class="text-md font-semibold ltr:mr-1 rtl:ml-1">Gesamtrechnungen</div>
                        <div x-data="dropdown" @click.outside="open = false" class="dropdown">
                            <!-- Dropdown ikone i opcije -->
                        </div>
                    </div>
                    <div class="mt-5 flex items-center">
                        <div class="text-3xl font-bold ltr:mr-3 rtl:ml-3">{{ number_format($totalInvoices) }}</div>
                        <div class="badge bg-white/30">{{ number_format($invoiceGrowthRate, 2) }}%</div>
                    </div>
                    <div class="mt-5 flex items-center font-semibold">
                        <!-- Ikona -->
                        Letzte Woche {{ number_format($invoicesLastWeek) }}
                    </div>
                </div>
                

                <!-- Bounce Rate -->
                <div class="panel bg-gradient-to-r from-fuchsia-500 to-fuchsia-400">
                    <div class="flex justify-between">
                        <div class="text-md font-semibold ltr:mr-1 rtl:ml-1">Gesamtgebote</div>
                        <div x-data="dropdown" @click.outside="open = false" class="dropdown">
                            <!-- Dropdown ikone i opcije -->
                        </div>
                    </div>
                    <div class="mt-5 flex items-center">
                        <div class="text-3xl font-bold ltr:mr-3 rtl:ml-3">{{ number_format($totalBids) }}</div>
                        <div class="badge bg-white/30">{{ number_format($bidGrowthRate, 2) }}%</div>
                    </div>
                    <div class="mt-5 flex items-center font-semibold">
                        <!-- Ikona i informacija o promjeni u odnosu na prethodnu sedmicu -->
                        Letzte Woche {{ number_format($bidGrowthRate, 2) }}%
                    </div>
                </div>
                
            </div>


            <div class="grid grid-cols-1 gap-6 xl:grid-cols-2">
                <div class="grid gap-6 xl:grid-flow-row">
                    <!-- Previous Statement -->
                    <div class="panel overflow-hidden">
                        <!-- Rest des Codes -->
                        <div class="flex items-center justify-between">
                            <div>
                                <div class="text-lg font-bold">Letzte Transaktionen</div>
                                <div class="text-success">Letzte Zahlung: {{ $lastPaymentDate }} von {{ $lastPayingCompany }}</div>
                            </div>
                            <!-- Rest des Codes für das Dropdown -->
                        </div>
                        <div class="relative mt-10">
                            <div class="grid grid-cols-2 gap-6 md:grid-cols-3">
                                <div>
                                    <div class="text-primary">Gesamtzahlungen</div>
                                    <div class="mt-2 text-2xl font-semibold">€{{ number_format($paidAmount, 2) }}</div>
                                </div>
                                <!-- Rest des Codes für andere Elemente -->
                            </div>
                        </div>
                    </div>
                    
                    
                    

                    <!-- Current Statement -->
                    <div class="panel overflow-hidden">
                        <div class="mb-5 text-lg font-bold">Offene Rechnungen</div>
                        <div class="table-responsive">
                            <table>
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Betrag</th>
                                        <th>Rechnungsdatum</th>
                                        <th>Fälligkeitsdatum</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Erstellt am</th>
                                        <th class="text-center">Firma</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($invoices as $invoice)
                                        <tr>
                                            <td class="font-semibold">{{ $invoice->id }}</td>
                                            <td>{{ number_format($invoice->amount, 2) }} €</td>
                                            <td>{{ $invoice->invoice_date->format('d.m.Y') }}</td>
                                            <td>{{ $invoice->due_date->format('d.m.Y') }}</td>                                            
                                            <td class="text-center">
                                                <span class="badge rounded-full {{ $invoice->status_class }}">
                                                    {{ $invoice->status }}
                                                </span>
                                            </td>
                                            <td>{{ $invoice->created_at->format('d.m.Y') }}</td>
                                            <td class="text-center">{{ $invoice->company->company_name }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
              
                </div>

                <!-- Recent Transactions -->
                <div class="panel">
                    <div class="mb-5 text-lg font-bold">Aktuelle Jobs</div>
                    <div class="table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>DATUM</th>
                                    <th>NAME</th>
                                    <th>Der Autor</th>
                                    <th class="text-center">STATUS</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($jobs as $job)
                                    <tr>
                                        <td class="font-semibold">{{ $job->id }}</td>
                                        <td class="whitespace-nowrap">{{ $job->created_at->format('M d, Y') }}</td>
                                        <td class="whitespace-nowrap">{{ $job->title }}</td>
                                        <td>{{ $job->user->name }}</td>
                                        <td class="text-center">
                                            <span class="badge rounded-full {{ $job->status_class }}">
                                                {{ $job->status }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>
@endsection