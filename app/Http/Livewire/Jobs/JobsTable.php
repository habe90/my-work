<?php

namespace App\Http\Livewire\Jobs;

use Livewire\Component;
use App\Models\Job;

class JobsTable extends Component
{
    public $search = '';
    public $statusFilter = '';
    public $isActiveFilter = '';
    public $dateFilter = '';

    public function render()
    {
        $query = Job::query();

        if (!empty($this->search)) {
            $query->where('title', 'like', '%' . $this->search . '%');
        }

        if (!empty($this->statusFilter)) {
            $query->where('status', $this->statusFilter);
        }

        if ($this->isActiveFilter !== '') {
            $query->where('is_active', $this->isActiveFilter == 'active');
        }

        if (!empty($this->dateFilter)) {
            $query->whereDate('created_at', $this->dateFilter);
        }

        $jobs = $query->get();

        return view('livewire.jobs.jobs-table', compact('jobs'));
    }
}
