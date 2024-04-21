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
        DB::beginTransaction();
        try {
            $bid = Bid::find($bidId);
            if (!$bid) {
                throw new \Exception('Bid not found');
            }

            $bid->status = 'accepted';
            $conversationId = $this->findOrCreateConversation($bid->user_id, $bidId);
            $bid->conversation_id = $conversationId;
            $bid->save();

            $this->sendAutomaticMessage($conversationId, $message);
            DB::commit();

            $this->emit('refreshComponent');
        } catch (\Exception $e) {
            DB::rollback();
            // handle error, e.g. emit error message
            $this->emit('error', $e->getMessage());
        }
    }



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
