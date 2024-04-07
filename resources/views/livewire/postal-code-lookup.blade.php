<div class="relative w-full mb-3">
    <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" for="postal_code">
        {{ __('global.postal_code') }}
    </label>
    <input id="postal_code" wire:model="postalCode" type="text" class="input-with-city"
        placeholder="{{ __('global.postal_code') }}" required autocomplete="postal-code" />
    @error('postal_code')
        <div class="text-red-500">
            <small>{{ $message }}</small>
        </div>
    @enderror
</div>

<style>
    .input-with-city {
        border: 1px solid #cccccc;
        /* Boja bordera po želji */
        padding: 8px;
        /* Padding po želji */
        font-size: 16px;
        /* Veličina fonta po želji */
    }
</style>
