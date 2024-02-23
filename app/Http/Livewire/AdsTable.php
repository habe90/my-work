<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\CompanyAdvertisement; // Ovde koristite pravi model za oglase
use App\Http\Livewire\WithSorting;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Response;

class AdsTable extends Component
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


    public function render()
    {
        $ads = CompanyAdvertisement::where('company_name', 'like', '%'.$this->search.'%')
            ->orWhere('offer_details', 'like', '%'.$this->search.'%') // Prilagodite pretragu poljima koja imate
            // Dodajte ostale uslove pretrage po potrebi
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate($this->perPage);

        return view('livewire.ads-table', compact('ads'));
    }


}
