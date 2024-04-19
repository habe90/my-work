<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class CompanyVerification extends Component
{
    use WithFileUploads;

    public $documents = [];
    public $uploadProgress = [];

    public function uploadDocuments()
    {
        foreach ($this->documents as $key => $document) {
            $this->validate([
                'documents.*' => 'file|mimes:pdf|max:10240', // Ograničenje na 10MB i PDF format
            ]);

            $filename = $document->getClientOriginalName();
            $path = Storage::putFileAs('public/verification_documents', $document, $filename);

            $this->uploadProgress[$filename] = __('messages.document_uploaded', [], app()->getLocale());
            $this->emit('fileUploaded', $key);
        }

        session()->flash('message', __('messages.documents_sent_for_verification', [], app()->getLocale()));
    }

    public function render()
    {
        return view('livewire.company-verification');
    }
}
