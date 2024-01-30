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
            'chart_title' => 'Total Jobs',
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

        // Povrat podataka u view
        return view('admin.home', compact('userCountSettings', 'jobCountSettings', 'jobs'));
    }
}
