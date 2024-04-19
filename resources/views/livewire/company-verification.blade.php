<div>
    <h3>{{ __('messages.upload_required_documents', [], app()->getLocale()) }}</h3>

    @foreach($documents as $index => $document)
        <div wire:key="document-{{ $index }}">
            {{ $document->getClientOriginalName() }}
            @if(array_key_exists($document->getClientOriginalName(), $uploadProgress))
                <span>&#10003; {{ $uploadProgress[$document->getClientOriginalName()] }}</span>
            @endif
        </div>
    @endforeach

    <input type="file" wire:model="documents" multiple>
    <div>
        @error('documents.*') <span class="error">{{ $message }}</span> @enderror
    </div>

    <button wire:click="uploadDocuments">{{ __('messages.send_documents', [], app()->getLocale()) }}</button>

    @if(session()->has('message'))
        <div>{{ session('message') }}</div>
    @endif
</div>
