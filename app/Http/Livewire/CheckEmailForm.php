<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Job;
use Illuminate\Support\Facades\Log;
use Auth;

class CheckEmailForm extends Component
{
    public $email;
    public $password;
    public $userExists = false;

    public function checkUser()
    {
        if ($this->userExists) {
            // Ako je userExists već true, pokrenite metodu za prijavu
            $this->login();
        } else {
            // Provjerite da li korisnik postoji
            $user = User::where('email', $this->email)->first();

            if ($user) {
                $this->userExists = true; // Postavite userExists na true da prikažete polje za lozinku
            } else {
                // Korisnik ne postoji, preusmjerite na registraciju
                return redirect()->route('register');
            }
        }
    }

    public function login()
    {
        // Ovdje dodajte logiku za prijavu korisnika
        $credentials = ['email' => $this->email, 'password' => $this->password];

        if (Auth::attempt($credentials)) {
            if (session()->has('form_data')) {
                // Preuzmite podatke forme iz sesije
                $formData = session('form_data');
                session()->forget('form_data'); // Odmah očistite podatke iz sesije

                // Ovdje implementirajte logiku za obradu sačuvanih podataka forme
                $this->handleFormData($formData);

                // Uspješna prijava, preusmjerite na željenu stranicu
                return redirect()->intended('dashboard');
            }
            return redirect()->intended('dashboard');
        } else {
            // Prijavljivanje nije uspjelo, dodajte poruku o grešci
            $this->addError('password', 'Weitere Informationen finden Sie hier.');
        }
    }

    protected function handleFormData($formData)
    {
        Log::info('Obrada podataka forme je započela', ['formData' => $formData]);
        $formName = decrypt($formData['formName']);
        $serviceCategoryId = session('service_category_id');
        // Provjerite da li je forma za posao
        if (in_array($formName, ['Rohbau Mauerarbeiten', 'Forma2', 'Forma3'])) {
            // Kreiranje novog posla
            $job = new Job(); 
            $job->title = $formData['title'];
            $job->description = $formData['description'];
            $job->service_category_id = $serviceCategoryId;
            $job->is_active = 0; 
            $job->status = 'pending'; 
            $job->user_id = Auth::id(); 
    
            if (isset($formData['additional_details'])) {
                $job->additional_details = json_encode($formData['additional_details']);
            }
    
            try {
                // Spremite posao u bazu
                $job->save();
                Log::info('Posao je uspješno sačuvan', ['jobId' => $job->id]);
    
                // Preusmjerite sa porukom o uspjehu
                session()->flash('success', __('global.data_add_sussesfully'));
                return redirect()->route('my-jobs');
            } catch (\Exception $e) {
                // Logujte grešku ako se dogodi
                Log::error('Greška prilikom sačuvavanja posla', ['error' => $e->getMessage()]);
                // Ovdje možete postaviti i sesijsku poruku o grešci ako želite
                session()->flash('error', __('global.data_add_error'));
                return redirect()->route('my-jobs');
            }
        } else {
            Log::info('Forma nije pronađena u listi posebnih poslova', ['formName' => $formData['formName']]);
            
        }
    }

    public function render()
    {
        return view('livewire.check-email-form');
    }
}
