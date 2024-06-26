<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Job;
use Auth;

class JobFilter extends Component
{
    public $activity;
    public $location;
    protected $jobs;
    public $perPage = 6;
    public $currentPage = 1;

    public function loadMore()
    {
        $this->currentPage++;
    }

    public function render()
    {
        $loggedInUser = Auth::user();

        $jobsQuery = Job::query();

        // Ako korisnik želi filtrirati poslove po lokaciji
        if ($this->location) {
            $coordinates = $this->getCoordinatesFromAddress($this->location);
            if ($coordinates) {
                $jobsQuery->whereRaw('ST_Distance_Sphere(point(longitude, latitude), point(?, ?)) <= ?', [
                    $coordinates['longitude'],
                    $coordinates['latitude'],
                    $radius * 1000, // Pretvorite radijus u metre
                ]);
            }
        }

        // Filtriranje poslova koji su 'active' i nisu 'completed'
        $jobsQuery = Job::where('status', 'active')
        ->where('status', '!=', 'pending')
        ->where('status', '!=', 'completed');

        // Prikazivanje najnovijih poslova prvo
        $jobsQuery->orderBy('created_at', 'desc');

        $jobs = $jobsQuery->paginate($this->perPage, ['*'], 'page', $this->currentPage);

        return view('livewire.job-filter', ['jobs' => $jobs]);
    }

    private function getCoordinatesFromAddress($address)
    {
        // Vaš API ključ za Google Maps
        $apiKey = config('services.google.api_key');

        // Provjerite da li je API ključ postavljen
        if (empty($apiKey)) {
            \Log::error('Google Maps API ključ nije konfigurisan.');
            return null;
        }

        // Pretvaranje adrese u URL-friendly format
        $address = urlencode($address);

        // Formiranje URL-a za Geocoding API
        $url = "https://maps.googleapis.com/maps/api/geocode/json?address={$address}&key={$apiKey}";

        // Slanje zahtjeva koristeći Guzzle ili neku drugu HTTP biblioteku
        $client = new \GuzzleHttp\Client();

        try {
            $response = $client->request('GET', $url);
            $body = $response->getBody();
            $data = json_decode($body);

            if ($data && $data->status == 'OK' && !empty($data->results)) {
                $coordinates = $data->results[0]->geometry->location;
                \Log::info('Koordinate za adresu ' . $address . ': ', (array) $coordinates);
                return [
                    'latitude' => $coordinates->lat,
                    'longitude' => $coordinates->lng,
                ];
            } else {
                // Logovanje ako nema rezultata ili ako je status odgovora različit od 'OK'
                \Log::warning("Google Maps API vratio status {$data->status} za adresu: {$address}");
                return null;
            }
        } catch (\Exception $e) {
            // Logovanje izuzetaka
            \Log::error('Izuzetak pri dohvatu koordinata: ' . $e->getMessage());
            return null;
        }
    }
}
