<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ServiceCategory;

class ChooseForm extends Component
{
    public $categoryId;

    public function mount($categoryId)
    {
        $this->categoryId = $categoryId;
    }

    public function render()
    {
        $category = ServiceCategory::findOrFail($this->categoryId);

        // Ovde možete dodati logiku za odabir odgovarajućeg view-a
        // na osnovu imena ili druge karakteristike kategorije

        return view('livewire.choose-form', [
            'categoryName' => $category->name,
        ]);
    }
}
