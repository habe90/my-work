<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\ImConversation;
use App\Models\ImMessage;
use App\Models\User;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;

class MessagesComponent extends Component
{

    use WithFileUploads;

    public $conversations;
    public $selectedConversation;
    public $selectedConversationId;
    public $fileUpload;
    public $newMessage = '';
    protected $listeners = [
        'messageReceived',
        'emojiSelected',
        'closeEmojiPicker',
        'toggleEmojiPicker'
    ];
    
    public $showEmojiPicker = false;

    public function toggleEmojiPicker()
    {
        $this->showEmojiPicker = !$this->showEmojiPicker;
    }



    public function mount()
    {
        $this->loadConversations();
    }

    // public function loadConversations()
    // {
    //     $user = auth()->user();
    //     $this->conversations = ImConversation::whereHas('bids', function ($query) use ($user) {
    //         $query->where('status', 'accepted')->whereHas('job', function ($q) use ($user) {
    //             $q->where('user_id', $user->id);
    //         });
    //     })->with(['bids.job', 'bids.user'])->get();
    // }

    public function loadConversations()
    {
        $user = auth()->user();
        $this->conversations = ImConversation::whereHas('recipients', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->with(['messages', 'recipients'])->get();
    }

    public function messageReceived($message)
    {
        $this->loadConversations(); 
    }

    public function markAsRead($conversationId)
{
    $recipient = DB::table('im_recipients')
        ->where('conversation_id', $conversationId)
        ->where('user_id', auth()->id())
        ->first();

    if ($recipient && is_null($recipient->seen_at)) {
        DB::table('im_recipients')
            ->where('conversation_id', $conversationId)
            ->where('user_id', auth()->id())
            ->update(['seen_at' => now()]);
    }
}


    
    public function selectConversation($conversationId)
    {
        $this->selectedConversationId = $conversationId;
        $this->selectedConversation = ImConversation::with(['bids.job', 'bids.user', 'messages.user'])
            ->find($conversationId);

        $this->markAsRead($conversationId);
    }


    public function sendMessage()
    {
        $this->validate([
            'newMessage' => 'nullable|string',
            'fileUpload' => 'nullable|file|max:2048', // Ovdje možete postaviti ograničenja za datoteke
        ]);

        // Provjerite da li je odabrana konverzacija
        if ($this->selectedConversation) {
            $messageText = $this->newMessage;

            // Ako postoji uploadovana datoteka, obradite je
            if ($this->fileUpload) {
                $filename = $this->fileUpload->store('public/uploads', 'local'); // Ovo će spremati datoteku u 'storage/app/public/uploads'
                $messageText = $filename; // Možete ovdje dodati logiku za generisanje URL-a ili neki drugi identifikator datoteke
            }

            // Kreirajte novu poruku
            $message = new ImMessage([
                'body' => $messageText,
                'user_id' => auth()->user()->id,
            ]);
            $this->selectedConversation->messages()->save($message);

            // Resetujte polje i uploadovanu datoteku nakon slanja
            $this->newMessage = '';
            $this->fileUpload = null;

            // Osvježite odabrani razgovor kako biste vidjeli novu poruku
            $this->selectedConversation = ImConversation::with(['bids.job', 'bids.user', 'messages.user'])
                ->find($this->selectedConversation->id);

            // Emitujte događaj za osvježavanje
            $this->emitTo('message-component', 'refreshComponent');
        }
    }


    public function isUserOnline($userId)
    {
        $user = User::find($userId); 
    
        if (!$user) {
            return false; 
        }
    
        // Provjerite da li je timestamp posljednje aktivnosti korisnika unutar npr. 5 minuta
        $lastActivity = strtotime($user->last_activity); 
    
        if (!$lastActivity) {
            return false; 
        }
    
        $fiveMinutesAgo = strtotime('-5 minutes'); 
    
        return $lastActivity > $fiveMinutesAgo; // Provjerava da li je posljednja aktivnost unutar vremenskog okvira
    }



    public function emojiSelected($emoji)
    {
        $this->newMessage .= $emoji;
    }
    

    public function render()
    {
        return view('livewire.messages-component', [
            'selectedConversation' => $this->selectedConversation, // Proslijedite varijablu u view
        ]);
    }

    public function deleteConversation($conversationId)
{
    $conversation = ImConversation::find($conversationId);

    // Provjerite da li je razgovor pronađen i da li trenutni korisnik ima dozvolu za brisanje
    if ($conversation && $this->userCanDeleteConversation($conversation)) {
        $conversation->delete();

        // Osvježite listu razgovora nakon brisanja
        $this->loadConversations();

        // Opcionalno: Resetujte selektovani razgovor ako je on bio obrisan
        if ($this->selectedConversationId == $conversationId) {
            $this->selectedConversationId = null;
            $this->selectedConversation = null;
        }

        // Opcionalno: Prikažite poruku o uspješnom brisanju
        session()->flash('message', 'Razgovor je uspješno obrisan.');
    } else {
        // Opcionalno: Prikažite poruku o grešci
        session()->flash('error', 'Razgovor nije pronađen ili nemate dozvolu za brisanje.');
    }
}

protected function userCanDeleteConversation($conversation)
{
    // Logika za provjeru da li trenutni korisnik ima dozvolu za brisanje razgovora
    // Na primjer, provjerite da li je trenutni korisnik vlasnik razgovora
    return auth()->id() == $conversation->user_id;
}

}
