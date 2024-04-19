<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class CompanyVerification extends Component
{
    use WithFileUploads;

    public $documents = [];
    public $documentCount = 0;

    public function updatedDocuments()
    {
        $this->validate([
            'documents.*' => 'file|mimes:pdf|max:10240', // Ograničenje na 10MB i PDF format
        ]);
    
        foreach ($this->documents as $document) {
            $this->documentCount++;
        }
    }
    
    public function saveDocuments()
    {
        foreach ($this->documents as $document) {
            $filename = $document->getClientOriginalName();
            $path = Storage::putFileAs('public/verification_documents', $document, $filename);
        }
    
        // Resetujemo polje dokumenata nakon uploada
        $this->documentCount = 0;
        $this->documents = [];
    
        session()->flash('message', 'Dokumenti su uspješno uploadani.');
    }
    

    public function render()
    {
        return view('livewire.company-verification');
    }
}
