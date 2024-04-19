<div>
    <input type="file" wire:model="documents" multiple>

    @foreach($documents as $index => $document)
        <div wire:key="document-{{ $index }}">
            {{ $document->getClientOriginalName() }}
            @if(array_key_exists($document->getClientOriginalName(), $uploadProgress))
                <span>&#10003; {{ $uploadProgress[$document->getClientOriginalName()] }}</span>
            @endif
        </div>
    @endforeach

    <button wire:click="uploadDocuments">{{ __('messages.send_documents', [], app()->getLocale()) }}</button>

    @if(session()->has('message'))
        <div>{{ session('message') }}</div>
    @endif
</div>
