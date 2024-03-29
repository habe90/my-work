<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\Bid;
use App\Models\User;
use App\Models\UserRating;
use App\Models\Invoice;
use Carbon\Carbon;
use Auth;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class HomeController
{
    public function index()
    {
        $userCountSettings = [
            'chart_title' => 'Gesamtzahl der Benutzer',
            'chart_type' => 'number_block',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\User',
            'group_by_field' => 'created_at',
            'group_by_period' => 'day',
            'aggregate_function' => 'count',
            'filter_field' => 'created_at',
            'group_by_field_format' => 'Y-m-d',
            'column_class' => 'col-md-6',
            'entries_number' => '5',
            // 'translation_key'       => 'totalUsers', // ako imate prijevod
        ];

        $jobCountSettings = [
            'chart_title' => 'Gesamtzahl der Jobs',
            'chart_type' => 'number_block',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Job',
            'group_by_field' => 'created_at',
            'group_by_period' => 'day',
            'aggregate_function' => 'count',
            'filter_field' => 'created_at',
            'group_by_field_format' => 'Y-m-d',
            'column_class' => 'col-md-6',
            'entries_number' => '5',
            // 'translation_key'       => 'totalJobs', // ako imate prijevod
        ];

        // Ukupan broj korisnika
        $userCountSettings['total_number'] = User::count();

        // Ukupan broj poslova
        $jobCountSettings['total_number'] = Job::count();

       // Izračunavanje broja novih korisnika u posljednjih 7 dana
        $oneWeekAgo = Carbon::now()->subWeek();
        $newUsersLastWeek = User::where('created_at', '>=', $oneWeekAgo)->count();

        // Izračunavanje promjene broja korisnika u tekućem mjesecu u odnosu na prošli mjesec
        $currentMonthStart = Carbon::now()->startOfMonth();
        $lastMonthStart = Carbon::now()
            ->subMonthNoOverflow()
            ->startOfMonth();
        $lastMonthEnd = Carbon::now()
            ->subMonthNoOverflow()
            ->endOfMonth();

        $usersLastMonth = User::whereBetween('created_at', [$lastMonthStart, $lastMonthEnd])->count();
        $usersCurrentMonth = User::where('created_at', '>=', $currentMonthStart)->count();

        $userGrowthRate = $usersLastMonth > 0 ? (($usersCurrentMonth - $usersLastMonth) / $usersLastMonth) * 100 : $usersCurrentMonth * 100;

        // Izračunavanje broja novih poslova u posljednjih 7 dana
        $oneWeekAgo = Carbon::now()->subWeek();
        $newJobsLastWeek = Job::where('created_at', '>=', $oneWeekAgo)->count();

        // Dodavanje izračunatih vrijednosti u postavke
        $userCountSettings['growth_rate'] = $userGrowthRate;
        $userCountSettings['new_last_week'] = $newUsersLastWeek;
        $jobCountSettings['new_last_week'] = $newJobsLastWeek;

        $jobs = Job::all(); 

        // Dohvat svih plaćenih faktura
        $paidInvoices = Invoice::where('status', 'paid')->get();

        // Ukupan iznos plaćenih faktura
        $paidAmount = $paidInvoices->sum('amount');

        // Dohvat posljednje plaćene fakture
        $lastPaidInvoice = $paidInvoices->sortByDesc('invoice_date')->first();

        // Prikupljanje informacija o posljednjoj uplati
        $lastPaymentDate = optional(optional($lastPaidInvoice)->invoice_date)->format('Y-m-d') ?? 'N/A';
        $invoices = Invoice::where('status', 'unpaid')
        ->with('company') // Pretpostavljam da imate relaciju 'company' u modelu Invoice
        ->get();

        
        $lastPayingCompany = optional($lastPaidInvoice)->company->name ?? 'N/A';

        // Ukupan broj ponuda
        $totalBids = Bid::count();

        // Izračunavanje promjene broja ponuda u posljednjih 7 dana
        $bidsLastWeek = Bid::whereBetween('created_at', [Carbon::now()->subWeek(), Carbon::now()])->count();
        $bidsWeekBefore = Bid::whereBetween('created_at', [Carbon::now()->subWeeks(2), Carbon::now()->subWeek()])->count();

        $bidGrowthRate = $bidsWeekBefore > 0 ? (($bidsLastWeek - $bidsWeekBefore) / $bidsWeekBefore) * 100 : 0;

        $totalInvoices = Invoice::count();

        $invoicesLastWeek = Invoice::whereBetween('created_at', [Carbon::now()->subWeek(), Carbon::now()])->count();
        $invoicesWeekBefore = Invoice::whereBetween('created_at', [Carbon::now()->subWeeks(2), Carbon::now()->subWeek()])->count();

        $invoiceGrowthRate = $invoicesWeekBefore > 0 ? (($invoicesLastWeek - $invoicesWeekBefore) / $invoicesWeekBefore) * 100 : 0;

        // Povrat podataka u view
        return view('admin.home', compact(
            'userCountSettings', 
            'jobCountSettings', 
            'jobs',
            'paidAmount', 
            'lastPaymentDate', 
            'lastPayingCompany',
            'invoices',
            'totalBids', 
            'bidGrowthRate',
            'totalInvoices', 
            'invoiceGrowthRate', 
            'invoicesLastWeek'
        ));
    }
}
