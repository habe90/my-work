<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Job;
use App\Models\Bid;
use App\Models\ImConversation;
use App\Models\ImMessage;
use Illuminate\Support\Facades\DB;

class ShowBids extends Component
{
    public $job;
    protected $listeners = ['refreshComponent' => '$refresh'];

    public function mount($jobId)
    {
        $this->job = Job::with([
            'bids' => function ($query) {
                $query->where('status', 'pending');
            },
        ])->findOrFail($jobId);
    }

    public function acceptBid($bidId)
    {
        $bid = Bid::find($bidId);
        
        if ($bid) {
            $bid->status = 'accepted';
    
            $conversationId = $this->findOrCreateConversation($bid->user_id, $bidId);
    
            $bid->conversation_id = $conversationId;
            $bid->save();
    
            // Slanje automatske poruke korisniku
            $this->sendAutomaticMessage($conversationId, "Vaša ponuda #$bidId je prihvaćena. Sada možete komunicirati sa kupcem.");
    
            $this->emit('refreshComponent');
        }
    }

    public function sendAutomaticMessage($conversationId, $messageText)
    {
        $conversation = ImConversation::find($conversationId);
        if ($conversation) {
            // Kreirajte novu poruku
            $message = new ImMessage([
                'body' => $messageText,
                'user_id' => auth()->user()->id, // ID korisnika koji šalje poruku, u ovom slučaju može biti ID sistema ili korisnika koji prihvata ponudu
            ]);
            $conversation->messages()->save($message);

            // Osvježavanje konverzacije da uključi novu poruku
            // ...
        }
    }

    public function findOrCreateConversation($userId, $bidId)
    {
        $currentUser = auth()->user();
    
        // Pronalazak postojeće konverzacije
        $conversation = ImConversation::whereHas('bids', function ($query) use ($currentUser, $userId) {
            $query->where('user_id', $currentUser->id)->orWhere('user_id', $userId);
        })->first();
    
        $justCreated = false;
    
        // Ako konverzacija ne postoji, kreirajte je
        if (!$conversation) {
            $conversation = new ImConversation();
            $conversation->owner_id = $currentUser->id;
            $conversation->subject = "Offer #$bidId accepted!";
            $conversation->save();
            $justCreated = true;
        }
    
        // Dodavanje korisnika u im_recipients ako je konverzacija upravo kreirana
        if ($justCreated) {
            DB::table('im_recipients')->insert([
                ['conversation_id' => $conversation->id, 'user_id' => $currentUser->id, 'seen_at' => null],
                ['conversation_id' => $conversation->id, 'user_id' => $userId, 'seen_at' => null],
            ]);
        }
    
        return $conversation->id;
    }


    public function render()
    {
        return view('livewire.show-bids');
    }

    public function deleteBid($bidId)
    {
        $bid = Bid::find($bidId);

        if ($bid) {
            $bid->delete();
            $this->emit('refreshComponent');
        }
    }
}
