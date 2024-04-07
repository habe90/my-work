<?php

namespace App\Http\Livewire;

use Livewire\Component;

class PostalCodeLookup extends Component
{
    public $postalCode;
    public $city;

    public function updatedPostalCode($value)
    {
        if ($value === '10115') {
            $this->postalCode = $value . ' | Berlin';
        } else {
            $this->postalCode = $value . ' | Unknown';
        }
    }
    

    public function render()
    {
        return view('livewire.postal-code-lookup');
    }
}
