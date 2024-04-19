<div>
    <div id="dropzone" class="upload_dropZone" wire:ignore>
        @foreach($documents as $index => $document)
            <div class="d-flex align-items-center justify-content-center mb-2">
                <span>{{ $document->getClientOriginalName() }}</span>
                <span class="text-success ml-2">&#10003;</span>
            </div>
        @endforeach

        @if ($documentCount < 3)
            <input type="file" wire:model="documents" id="document-upload" multiple hidden>
            <label for="document-upload" class="btn btn-upload mb-3">Odaberite fajlove ili prevucite dokumente ovdje</label>
            <div wire:loading wire:target="documents">Upload u toku...</div>
        @endif

        @if ($documentCount > 0 && $documentCount < 3)
            <button wire:click="uploadDocument" class="btn btn-primary mt-2">Pošalji dokumente</button>
        @endif

        @if(session()->has('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
        @endif
    </div>

    <script>
        document.addEventListener('livewire:load', function () {
            let dropzone = document.getElementById('dropzone');

            dropzone.addEventListener('dragover', event => {
                event.preventDefault();
            });

            dropzone.addEventListener('drop', event => {
                event.preventDefault();
                let files = event.dataTransfer.files;
                let fileInput = document.getElementById('document-upload');
                fileInput.files = files;

                // Trigger Livewire file upload
                Livewire.emit('fileUpload', fileInput.getAttribute('wire:model'), files);
            });
        });
    </script>
</div>
