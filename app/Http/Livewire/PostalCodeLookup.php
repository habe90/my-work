<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class PostalCodeLookup extends Component
{
    public $postalCode;
    public $city;

    public function updatedPostalCode($value)
    {
        if (strlen($value) === 5) {
            $response = Http::get("https://api.postcodes.io/postcodes/{$value}/autocomplete");
    
            if ($response->successful()) {
                $data = $response->json();
                // You'll need to parse this $data to find the city or area name
                // Assume we have the city name in $data['result'][0]
                $this->postalCode = $value . ' | ' . $data['result'][0];
            } else {
                $this->postalCode = $value . ' | Unknown';
            }
        }
    }
    

    public function render()
    {
        return view('livewire.postal-code-lookup');
    }
}
