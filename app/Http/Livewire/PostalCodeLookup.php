<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PostalCodeLookup extends Component
{
    public $postalCode;
    public $address;

    public function updatedPostalCode($value)
    {
        if (!empty($value)) {
            $this->address = $this->getAddressFromPostalCode($value);
        }
    }

    private function getAddressFromPostalCode($postalCode)
    {
        $apiKey = config('services.google.api_key');

        if (empty($apiKey)) {
            Log::error('Google Maps API key is not configured.');
            return 'Unknown Address';
        }

        $postalCode = urlencode($postalCode);
        $url = "https://maps.googleapis.com/maps/api/geocode/json?address={$postalCode}&key={$apiKey}";

        try {
            $response = Http::get($url);
            $data = $response->json();

            if ($data && $data['status'] === 'OK' && !empty($data['results'])) {
                // Uzmi formatiranu adresu iz prvog rezultata
                return $data['results'][0]['formatted_address'];
            } else {
                Log::warning("Google Maps API returned status {$data['status']} for postal code: {$postalCode}");
                return 'Unknown Address';
            }
        } catch (\Exception $e) {
            Log::error("Exception when getting address: " . $e->getMessage());
            return 'Unknown Address';
        }
    }

    public function render()
    {
        return view('livewire.postal-code-lookup');
    }
}
