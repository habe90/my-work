<div>
    <label for="amount">Iznos:</label>
    <input type="number" wire:model="amount" id="amount" class="form-control" />
    <span class="text-danger">@error('amount') {{ $message }} @enderror</span>
    
    <label for="comment">Komentar:</label>
    <textarea wire:model="comment" id="comment" class="form-control"></textarea>
    <span class="text-danger">@error('comment') {{ $message }} @enderror</span>

    <button wire:click="updateBid" class="btn btn-primary mt-2">Ažuriraj Ponudu</button>
</div>
