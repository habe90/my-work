<?php

namespace App\Http\Livewire;

use Livewire\Component;

class PostalCodeLookup extends Component
{
    public $postalCode;
    public $city;

    public function updatedPostalCode($value)
    {
        // Ovde biste izvršili poziv ka API-ju ili nekoj interni servisu za pretragu
        // Ovaj primer samo postavlja ime grada na osnovu unetog poštanskog koda
        if ($value === '10115') {
            $this->city = 'Berlin';
        } else {
            $this->city = 'Unknown';
        }
    }

    public function render()
    {
        return view('livewire.postal-code-lookup');
    }
}
