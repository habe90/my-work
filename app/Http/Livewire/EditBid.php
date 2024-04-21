<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Bid;

class EditBid extends Component
{
    public Bid $bid;
    public $amount;
    public $comment;
    public $isEditing = false; // Dodavanje ove varijable

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

    public function startEditing()
    {
        if ($this->bid->edit_count < 3) {
            $this->isEditing = true; // Samo postavljate način uređivanja
        } else {
            $this->emit('alert', ['type' => 'error', 'message' => 'Limit za izmjenu je dostignut.']);
        }
    }

    public function updateBid()
    {
        $this->validate();

        $this->bid->update([
            'amount' => $this->amount,
            'comment' => $this->comment,
            'edit_count' => $this->bid->edit_count + 1,
        ]);

        $this->isEditing = false; // Deaktivacija uređivanja
        $this->emit('alert', ['type' => 'success', 'message' => 'Ponuda je uspješno ažurirana.']);
    }

    public function render()
    {
        return view('livewire.edit-bid');
    }
}
