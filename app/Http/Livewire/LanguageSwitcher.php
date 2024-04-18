<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Session;

class LanguageSwitcher extends Component
{
    public array $languages = [];

    public string $currentLanguage;

    public function mount()
    {
        // Provjera da li postoji jezik u sesiji ili kolačiću
        $locale = session('locale', request()->cookie('locale', config('app.locale')));
    
        $this->languages = config('project.supported_languages');
        $this->currentLanguage = $locale;
    
        // Postavljanje jezika aplikacije na osnovu odabrane vrijednosti
        app()->setLocale($this->currentLanguage);
    }
    

    public function changeLocale(string $localeCode)
    {
        if (auth()->check()) {
            auth()->user()->update(['locale' => $localeCode]);
        } else {
            session(['locale' => $localeCode]);
            cookie()->queue('locale', $localeCode, 43200); // Traje 30 dana
        }
    
        app()->setLocale($localeCode);
        session()->flash('locale', $localeCode); // Dodajemo flash sesiju za promjenu jezika
    
        $this->emit('localeChanged'); // Emitujemo događaj za osvježavanje stranice
    }
    

    public function render()
    {
        return view('livewire.language-switcher');
    }
}
