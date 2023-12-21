<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ServiceCategory;

class SearchCategories extends Component
{
    public $searchTerm = '';
    public $searchResults = [];
    public $showDropdown = false;

    public function updatedSearchTerm()
    {
        // Sakrij rezultate pretrage ako je searchTerm prazan
        if (strlen($this->searchTerm) < 1) {
            $this->searchResults = [];
            $this->showDropdown = false;
        } else {
            // Ako postoji searchTerm, izvrši pretragu
            $this->searchResults = ServiceCategory::where('name', 'like', '%' . $this->searchTerm . '%')
                ->orWhere('description', 'like', '%' . $this->searchTerm . '%')
                ->get();

            // Prikaži dropdown jer imamo rezultate
            $this->showDropdown = true;
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

    public function highlightResult()
    {
        // Dodajte logiku za hover efekat i boldiranje ovde
    }
    public function selectCategory($categoryId)
    {
        // Sačuvajte odabranu kategoriju u sesiji
        session(['selectedCategory' => $categoryId]);
    
        $this->dispatch('categorySelected', ['categoryId' => $categoryId]);

        return redirect()->to('/post-service-request/' . $categoryId);

    }
}
