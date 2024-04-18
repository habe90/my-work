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
        $this->languages       = config('project.supported_languages');
        $this->currentLanguage = app()->getLocale();
    }

    public function changeLocale(string $localeCode)
    {
        if (auth()->check()) {
            auth()->user()->update(['locale' => $localeCode]);
        } else {
            session(['locale' => $localeCode]);
            // Možete postaviti i kolačić ako želite da jezik ostane zapamćen i nakon zatvaranja browsera
            cookie()->queue('locale', $localeCode, 43200); // Traje 30 dana
        }

        app()->setLocale($localeCode);

        return redirect(request()->header('Referer'));
    }

    public function render()
    {
        return view('livewire.language-switcher');
    }
}
