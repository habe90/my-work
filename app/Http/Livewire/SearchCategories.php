<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\ServiceCategory;

class SearchCategories extends Component
{
    public $searchTerm = '';
    public $searchResults = [];
    public $showDropdown = false;

    public function updatedSearchTerm()
    {
        if (strlen($this->searchTerm) >= 3) {
            $this->searchResults = ServiceCategory::with(['forms' => function ($query) {
                $query->where('name', 'like', '%' . $this->searchTerm . '%');
            }])->where(function ($query) {
                $query->where('name', 'like', '%' . $this->searchTerm . '%')
                      ->orWhere('description', 'like', '%' . $this->searchTerm . '%');
            })->orWhereHas('forms', function ($query) {
                $query->where('name', 'like', '%' . $this->searchTerm . '%');
            })->get();
    
            $this->showDropdown = true;
        } else {
            $this->searchResults = [];
            $this->showDropdown = false;
        }
    }
    
    

    public function render()
    {
        return view('livewire.search-categories', [
            'searchResults' => $this->searchResults,
        ]);
    }

    public function hideDropdown()
    {
        // Emitirajte događaj kako biste zatvorili dropdown nakon određenog vremena
        $this->dispatchBrowserEvent('close-dropdown');
    }

    public function performSearch()
    {
        // Proverite da li je searchTerm prazan ili ima manje od 3 karaktera
        if (strlen($this->searchTerm) < 3) {
            // Ako je searchTerm prazan ili ima manje od 3 karaktera, ne pretražujte ništa
            $this->searchResults = [];
            $this->showDropdown = false;
        } else {
            // Izvršite pretragu koristeći $this->searchTerm
            $this->searchResults = ServiceCategory::where('name', 'like', '%' . $this->searchTerm . '%')
                ->orWhere('description', 'like', '%' . $this->searchTerm . '%')
                ->get();

            // Prikažite dropdown jer imate rezultate
            $this->showDropdown = true;
        }
    }

    public function selectForm($formId)
    {
        // Ovdje možete napisati logiku koja će se desiti kada se odabere forma.
        // Na primjer, možete sačuvati odabranu formu u sesiji, ili
        // preusmjeriti korisnika na stranicu te forme.

        // Sačuvajte odabranu formu u sesiji
        session(['selectedForm' => $formId]);

        // Primjer preusmjeravanja na stranicu forme
        return redirect()->to('/post-service-request/' . $formId);
    }

    public function highlightResult()
    {
        // Dodajte logiku za hover efekat i boldiranje ovde
    }
    public function selectCategory($categoryId)
    {
        // Sačuvajte odabranu kategoriju u sesiji
        session(['selectedCategory' => $categoryId]);
    
        $this->getDispatchQueue('categorySelected', ['categoryId' => $categoryId]);

        return redirect()->to('/post-service-request/' . $categoryId);

    }
}
