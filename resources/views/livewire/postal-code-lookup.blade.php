<div class="relative w-full mb-3">
    <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" for="address">
        {{ __('global.postal_code') }}
    </label>
    <input id="address" wire:model.lazy="address" type="text" class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full input-with-city"
    placeholder="{{ __('global.postal_code') }}" required autocomplete="postal-code" name="address" />

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
