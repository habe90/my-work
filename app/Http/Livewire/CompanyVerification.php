<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;

class CompanyVerification extends Component
{
    use WithFileUploads;

    public $documents = [];
    public $uploadProgress = [];

    public function uploadDocuments()
{
    $this->validate([
        'documents.*' => 'file|mimes:pdf|max:10240', // Ograničenje na 10MB i PDF format
    ]);

    $attachments = [];

    foreach ($this->documents as $document) {
        $filename = $document->getClientOriginalName();
        $path = Storage::putFileAs('public/verification_documents', $document, $filename);
        $attachments[] = storage_path('app/public/verification_documents/' . $filename);
        $this->uploadProgress[$filename] = __('messages.document_uploaded', [], app()->getLocale());
    }

    if (count($attachments) > 0) {
        $this->sendEmailWithAttachments($attachments);
    }
}

private function sendEmailWithAttachments($attachments)
{
    Mail::raw('Dokumenti su priloženi.', function ($message) use ($attachments) {
        $message->to('habetech@gmail.com')->subject('Verifikacija Dokumenata Firme');

        foreach ($attachments as $attachmentPath) {
            $message->attach($attachmentPath);
        }
    });

    session()->flash('message', __('messages.documents_sent_for_verification', [], app()->getLocale()));
    $this->emit('refreshComponent');
}



    public function render()
    {
        return view('livewire.company-verification');
    }
}
