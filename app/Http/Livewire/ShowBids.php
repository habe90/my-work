<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Job;
use App\Models\Bid;
use App\Models\ImConversation;
use App\Models\ImMessage;
use Illuminate\Support\Facades\DB;
use App\Models\SuccessfulJob;

class ShowBids extends Component
{
    public $job;
    protected $listeners = [
        'refreshComponent' => '$refresh',
        'refreshBids' => '$refresh'
    ];


    

    public function mount($jobId)
    {
        $this->job = Job::with([
            'bids' => function ($query) {
                $query->where('status', 'pending');
            },
        ])->findOrFail($jobId);
    }

    public function getListeners()
    {
        return [
            "echo:bid.{$this->bid->id},BidUpdated" => 'refreshComponent',
        ];
    }

    
    public function refreshComponent()
    {
        // Ova metoda će se pozvati kada se emituje BidUpdated event za bid sa određenim ID-om
        // Ovdje možete dodati logiku za osvježavanje komponente, na primjer:
        $this->job->refresh();
    }


    public function acceptBid($bidId)
    {
        $bid = Bid::find($bidId);
        
        if ($bid) {
            $bid->status = 'accepted';
            $conversationId = $this->findOrCreateConversation($bid->user_id, $bidId);
            $bid->conversation_id = $conversationId;
            $bid->save();

            $userLocale = $bid->user->locale ?? app()->getLocale();
            $message = __('front.bid_accepted', ['bidId' => $bidId], $userLocale);

            // Slanje automatske poruke korisniku
            $this->sendAutomaticMessage($conversationId, $message);

            // Emitovanje osvježavanja komponente
            $this->emit('refreshComponent');

            // Osvježavanje stranice za prikaz promjena
            $this->emitTo('show-bids', 'refreshComponent');
        }
    }


    // public function acceptBid($bidId)
    // {
    //     $bid = Bid::find($bidId);
        
    //     if ($bid) {
    //         $bid->status = 'accepted';
    //         $conversationId = $this->findOrCreateConversation($bid->user_id, $bidId);
    //         $bid->conversation_id = $conversationId;
    //         $bid->save();

    //         $userLocale = $bid->user->locale ?? app()->getLocale();
    //         $message = __('front.bid_accepted', ['bidId' => $bidId], $userLocale);

    //         // Slanje automatske poruke korisniku
    //         $this->sendAutomaticMessage($conversationId, $message);

    //         // Emitovanje osvježavanja komponente
    //         $this->emit('refreshComponent');

    //         // Osvježavanje stranice za prikaz promjena
    //         $this->emitTo('show-bids', 'refreshComponent');
    //     }
    // }



    protected function calculateAmountDue(Bid $bid)
    {
        // Implementirajte logiku za izračunavanje iznosa koji firma duguje platformi
        // Može biti fiksni iznos, postotak od ponude, ili neki drugi kriterijum
        return 100; // Ovo je samo primjer
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

        
        }
    }

    public function findOrCreateConversation($userId, $bidId)
    {
        $currentUser = auth()->user();
    
        // Kreirajte novu konverzaciju za svaku ponudu
        $conversation = new ImConversation();
        $conversation->owner_id = $currentUser->id;
        $conversation->subject = "Offer #$bidId accepted!";
        $conversation->save();
        
        // Dodajte korisnike u im_recipients
        DB::table('im_recipients')->insert([
            ['conversation_id' => $conversation->id, 'user_id' => $currentUser->id, 'seen_at' => null],
            ['conversation_id' => $conversation->id, 'user_id' => $userId, 'seen_at' => null],
        ]);
        
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
