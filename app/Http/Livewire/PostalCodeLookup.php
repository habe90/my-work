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
            // Replace 'de' with the appropriate country code if necessary
            $response = Http::get("https://openplzapi.org/de/Localities?postalCodePattern={$value}");

            if ($response->successful()) {
                $data = $response->json();
                if (!empty($data['localities'])) {
                    $this->postalCode = $value . ' | ' . $data['localities'][0]['locality'];
                } else {
                    $this->postalCode = $value . ' | Unknown';
                }
            } else {
                $this->postalCode = $value . ' | Unknown';
            }
        } else {
            $this->city = '';
        }
    }
    

    public function render()
    {
        return view('livewire.postal-code-lookup');
    }
}
