<div>
    {{-- Ovdje ide drag-and-drop funkcionalnost sa JavaScriptom --}}
    <div id="dropzone" wire:ignore>
        {{-- Dropzone prostor --}}
        <input type="file" id="document-upload" multiple hidden wire:model="documents">
        <label for="document-upload" class="btn btn-primary">Odaberite fajlove ili prevucite dokumente ovdje</label>
    </div>

    {{-- Prikaz uploadanih dokumenata --}}
    @foreach($documents as $document)
        <div class="file-uploaded">
            <span>{{ $document->getClientOriginalName() }}</span>
            <span class="text-success">&#10003;</span>
        </div>
    @endforeach

    @if($documentCount < 3)
        <button wire:click="uploadDocuments" class="btn btn-primary">Pošalji dokumente</button>
    @endif

    <script>
        document.addEventListener('livewire:load', function () {
            let inputElement = document.getElementById('document-upload');
            let dropzone = document.getElementById('dropzone');

            dropzone.addEventListener('dragover', (event) => {
                event.preventDefault();
            });

            dropzone.addEventListener('drop', (event) => {
                event.preventDefault();
                inputElement.files = event.dataTransfer.files;
                // Emitujemo događaj 'fileUpload' sa Livewire komponentom
                @this.emit('fileUpload', event.dataTransfer.files);
            });
        });
    </script>
</div>
