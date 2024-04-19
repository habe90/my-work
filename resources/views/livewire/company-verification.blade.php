
<div>
    <h1 class="h4 text-center mb-3">Primjer uploada datoteka drag & drop metodom</h1>

    <div wire:ignore id="dropzone" class="upload_dropZone text-center mb-3 p-4">
        {{-- Ovdje će se prikazati uploadani fajlovi --}}
        <div class="upload_gallery d-flex flex-wrap justify-content-center gap-3 mb-0"></div>

        <input type="file" id="upload_documents" class="position-absolute invisible" wire:model="documents" multiple>
        <label for="upload_documents" class="btn btn-upload mb-3">Odaberite datoteke</label>

        @foreach($documents as $document)
            <div>{{ $document->getClientOriginalName() }}</div>
        @endforeach

        @if($documentCount)
            <button wire:click="saveDocuments" class="btn btn-primary mt-2">Pošalji dokumente</button>
        @endif
    </div>

    @if(session()->has('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    <script>
        document.addEventListener('livewire:load', function () {
            let dropzone = document.getElementById('dropzone');
            let uploadInput = document.getElementById('upload_documents');

            dropzone.addEventListener('dragover', event => event.preventDefault());
            dropzone.addEventListener('drop', event => {
                event.preventDefault();
                let files = event.dataTransfer.files;
                let fileInput = document.getElementById('upload_documents');
                fileInput.files = files;
                Array.from(files).forEach(file => {
                    // Ovdje pozovite Livewire metodu ili emitujte događaj za obradu fajla
                });
            });
        });
    </script>
</div>
