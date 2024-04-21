<div>
    <label for="amount">{{ __('global.bid_amount') }}</label>
    <input type="number" wire:model="amount" id="amount" class="form-control" />
    <span class="text-danger">@error('amount') {{ $message }} @enderror</span>
    
    <label for="comment">{{ __('global.comment') }}</label>
    <textarea wire:model="comment" id="comment" class="form-control"></textarea>
    <span class="text-danger">@error('comment') {{ $message }} @enderror</span>

    <button wire:click="updateBid" class="btn btn-primary mt-2">{{ __('global.update_offer') }}</button>
</div>
