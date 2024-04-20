<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Bid;

class EditBid extends Component
{
    public Bid $bid;
    public $amount;
    public $comment;

    protected $rules = [
        'amount' => 'required|numeric',
        'comment' => 'nullable|string',
    ];

    public function mount(Bid $bid)
    {
        $this->bid = $bid;
        $this->amount = $bid->amount;
        $this->comment = $bid->comment;
    }

    public function updateBid()
    {
        $this->validate();

        if ($this->bid->edit_count >= 3) {
            $this->emit('alert', ['type' => 'error', 'message' => 'Limit za izmjenu je dostignut.']);
            return;
        }

        $this->bid->update([
            'amount' => $this->amount,
            'comment' => $this->comment,
            'edit_count' => $this->bid->edit_count + 1,
        ]);

        $this->emit('alert', ['type' => 'success', 'message' => 'Ponuda je uspješno ažurirana.']);
    }

    public function render()
    {
        return view('livewire.edit-bid');
    }
}
