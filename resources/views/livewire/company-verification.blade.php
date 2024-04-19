<div>
    @for ($i = 0; $i < $documentCount; $i++)
        <div class="uploaded-document">
            <span>{{ $documents[$i]->getClientOriginalName() }}</span>
            <span class="text-success">&#10003;</span>
        </div>
    @endfor

    @if ($documentCount < 3)
        <div wire:loading wire:target="documents">Uploading...</div>
        <input type="file" wire:model="documents" multiple>
    @endif

    @if ($documentCount > 0 && $documentCount < 3)
        <button wire:click="uploadDocuments" class="btn btn-primary mt-2">{{ __('messages.send_documents', [], app()->getLocale()) }}</button>
    @endif

    @if(session()->has('message'))
        <div>{{ session('message') }}</div>
    @endif
</div>

<script>
    Livewire.on('allDocumentsUploaded', () => {
        // Sakrij input i prikaži poruku o uspješnom uploadu
    });
</script>
@push('styles')
<style>
    .uploaded-document {
    display: flex;
    align-items: center;
    justify-content: center;
}

.uploaded-document span {
    margin-right: 10px;
}

[wire\:loading] {
    display: block;
    text-align: center;
}

.btn-primary.mt-2 {
    display: block;
    width: 100%;
    margin-top: 10px;
}

</style>

 @endpush