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
        if (!empty($value) && strlen($value) === 5) {
            $response = Http::get("https://api.postcodes.io/postcodes/{$value}/autocomplete");

            if ($response->successful()) {
                $data = $response->json();

                // Dodajte provjeru da li 'result' postoji i nije prazan
                if (!empty($data['result'])) {
                    $this->city = $value . ' | ' . $data['result'][0];
                } else {
                    $this->city = $value . ' | Unknown';
                }
            } else {
                $this->city = $value . ' | Unknown';
            }
        } elseif (empty($value)) {
            $this->city = '';
        }
    }

    

    public function render()
    {
        return view('livewire.postal-code-lookup');
    }
}
