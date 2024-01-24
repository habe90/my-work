<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\Bid;
use App\Models\UserRating;
use App\Models\Invoice;
use Auth;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class CompanyDashboardController extends Controller
{
    public function index()
    {

        $settings1 = [
            'chart_title'           => 'Offers',
            'chart_type'            => 'number_block',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\Models\Bid', 
            'group_by_field'        => 'created_at',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'count',
            'filter_field'          => 'created_at',
            'group_by_field_format' => 'm/d/Y H:i:s',
            'column_class'          => 'col-xl-3 col-lg-6 col-md-6 col-sm-12',
            'entries_number'        => '5',
            'translation_key'       => 'offer', 
        ];

        $settings2 = [
            'chart_title'           => 'Total reviews',
            'chart_type'            => 'number_block',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\Models\UserRating', 
            'group_by_field'        => 'created_at',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'count',
            'filter_field'          => 'created_at',
            'group_by_field_format' => 'Y-m-d',
            'column_class'          => 'col-md-6',
            'entries_number'        => '5',
            'translation_key'       => 'userRating', 
        ];

        $settings3 = [
            'chart_title'           => 'Completed',
            'chart_type'            => 'number_block',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\Models\Job',
            'group_by_field'        => 'created_at',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'count',
            'filter_field'          => 'created_at',
            'group_by_field_format' => 'Y-m-d',
            'column_class'          => 'col-md-6',
            'entries_number'        => '5',
            'translation_key'       => 'completedJobs',
        ];

        $settings1['total_number'] = 0;
        if (class_exists($settings1['model'])) {
            $settings1['total_number'] = $settings1['model']::when(isset($settings1['filter_field']), function ($query) use ($settings1) {
                if (isset($settings1['filter_days'])) {
                    return $query->where($settings1['filter_field'], '>=',
                        now()->subDays($settings1['filter_days'])->format('Y-m-d'));
                } elseif (isset($settings1['filter_period'])) {
                    switch ($settings1['filter_period']) {
                        case 'week': $start = date('Y-m-d', strtotime('last Monday'));
                        break;
                        case 'month': $start = date('Y-m') . '-01';
                        break;
                        case 'year': $start = date('Y') . '-01-01';
                        break;
                    }
                    if (isset($start)) {
                        return $query->where($settings1['filter_field'], '>=', $start);
                    }
                }
            })
                ->{$settings1['aggregate_function'] ?? 'count'}($settings1['aggregate_field'] ?? '*');
        }

        $userRatingsCount = UserRating::where(function ($query) {
            $userId = auth()->id();
            $query->where('rater_id', $userId) 
                  ->orWhere('rated_user_id', $userId); 
        })->count();

        $settings2['total_number'] = $userRatingsCount;

        $jobs = Job::with(['bids'])
                    ->where('user_id', auth()->id())
                    ->get();

                    $completedJobsCount = Job::with(['bids'])
                    ->where('user_id', auth()->id())
                    ->where('status', 'done')
                    ->count();
                    $settings3['total_number'] = $completedJobsCount;
                    
                    $user = auth()->user();
                    $bids = Bid::where('user_id', $user->id)
                    ->whereIn('status', ['accepted', 'rejected'])
                    ->with('job') 
                    ->get();

        $invoices = Invoice::where('company_id', Auth::id())->get();

       
        return view('frontend.dashboard.company_dash', compact('settings1','settings2','settings3','jobs','bids', 'invoices'));
    }
}
