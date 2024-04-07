<div>
  

    <div class="relative w-full mb-3">
        <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" for="postal_code">
            {{ __('global.postal_code') }}
        </label>
        <input id="postal_code" wire:model.lazy="postalCode" type="text" 
               class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full"
               placeholder="{{ __('global.postal_code') }}" required autocomplete="postal-code" />

        {{-- Vidljivo polje za adresu (samo za čitanje ili onemogućeno ako ne želite da korisnik može mijenjati) --}}
        <input type="text" wire:model="formattedAddress" readonly
               class="mt-2 border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full"
               placeholder="Address will be shown here" />
               
        {{-- Skriveno polje koje će biti poslano sa formom --}}
        <input type="hidden" name="address" wire:model="formattedAddress">
        
        @error('postal_code')
            <div class="text-red-500">
                <small>{{ $message }}</small>
            </div>
        @enderror
    </div>
    

</div>
