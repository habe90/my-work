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

        $user = auth()->user();
        if ($user->verification_documents_submitted) {
            session()->flash('error', __('messages.documents_already_submitted', [], app()->getLocale()));
            return;
        }
    
       

        $attachments = [];

        foreach ($this->documents as $document) {
            $filename = $document->getClientOriginalName();
            $path = Storage::putFileAs('public/verification_documents', $document, $filename);
            $attachments[] = storage_path('app/public/verification_documents/' . $filename);
            $this->uploadProgress[$filename] = __('messages.document_uploaded', [], app()->getLocale());
        }

        if (count($attachments) > 0) {
            $user_name = auth()->user()->name;
            $this->sendEmailWithAttachments($attachments, $user_name);
        }
    }

private function sendEmailWithAttachments($attachments, $user_name)
{
    $user = auth()->user(); 
    $subject = __('messages.email_subject', [], app()->getLocale());
    $body = __('messages.email_body', ['user_name' => $user_name], app()->getLocale());
    $thankYou = __('messages.email_thank_you', [], app()->getLocale());
    $signature = __('messages.email_signature', [], app()->getLocale());

    Mail::raw("{$body}\n\n{$thankYou}\n\n{$signature}", function ($message) use ($attachments, $subject, $user) {
        $message->to('habetech@gmail.com')->subject($subject);
    
        foreach ($attachments as $attachmentPath) {
            $message->attach($attachmentPath, [
                'as' => basename($attachmentPath),
                'mime' => 'application/pdf',
            ]);
        }
    
        $user->verification_documents_submitted = 1;
        $user->save();
    });

    session()->flash('message', __('messages.documents_sent_for_verification', [], app()->getLocale()));
    $this->emit('refreshComponent');
}

    public function render()
    {
        $user = auth()->user();
        $documentsAlreadySubmitted = $user->verification_documents_submitted;

        return view('livewire.company-verification', [
        'documentsAlreadySubmitted' => $documentsAlreadySubmitted
        ]);

    }
}
