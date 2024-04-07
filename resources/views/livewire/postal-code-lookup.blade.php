<div>
    <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" for="postal_code">
        {{ __('global.postal_code') }}
    </label>
    <input id="postal_code" wire:model.lazy="postalCode" type="text" 
           class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full"
           placeholder="{{ __('global.postal_code') }}" required autocomplete="postal-code" />
           
    <input type="text" wire:model="displayAddress" disabled 
           class="mt-2 border-0 px-3 py-3 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full"
           placeholder="Address will be shown here" />

    <input type="hidden" name="address" wire:model="address"> <!-- Skriveno polje za slanje adrese -->

    @error('postalCode')
        <div class="text-red-500">
            <small>{{ $message }}</small>
        </div>
    @enderror
</div>
