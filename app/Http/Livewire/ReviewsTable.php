<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\MyWorkReview;
use App\Http\Livewire\WithSorting;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Response;

class ReviewsTable extends Component
{
    use WithPagination, WithSorting;

    public $perPage;
    public $search = '';
    public $selected = [];
    public $paginationOptions;
    protected $listeners = ['deleteConfirmed' => 'deleteSelected'];


    protected $queryString = [
        'search' => [
            'except' => '',
        ],
        'sortBy' => [
            'except' => 'id',
        ],
        'sortDirection' => [
            'except' => 'desc',
        ],
    ];

    public function getSelectedCountProperty()
    {
        return count($this->selected);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingPerPage()
    {
        $this->resetPage();
    }

    public function resetSelected()
    {
        $this->selected = [];
    }

    public function mount()
    {
        $this->sortBy            = 'id';
        $this->sortDirection     = 'desc';
        $this->perPage           = 10;
        $this->paginationOptions = config('project.pagination.options');
    }

    public function render()
    {
        $reviews = MyWorkReview::where('name', 'like', '%'.$this->search.'%')
            ->orWhere('position', 'like', '%'.$this->search.'%')
            ->orWhere('description', 'like', '%'.$this->search.'%')
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate($this->perPage);

        return view('livewire.reviews-table', compact('reviews'));
    }

    public function deleteSelected($id)
    {
        // abort_if(Gate::denies('review_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
    
        $review = MyWorkReview::find($id);
    
        if ($review) {
            $review->delete();
            $this->resetSelected();
        }
    }
    

    public function delete(MyWorkReview $review)
    {
        abort_if(Gate::denies('review_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $review->delete();
    }
}
