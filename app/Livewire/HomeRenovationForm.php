<?php

namespace App\Livewire;

use Livewire\Component;

class HomeRenovationForm extends Component
{
    public $nazivProjekta;
    // Ostale varijable za polja

    public function submitRenovacija()
    {
        // Logika za obradu formulara
    }

    public function render()
    {
        return view('livewire.home-renovation-form');
    }
}
