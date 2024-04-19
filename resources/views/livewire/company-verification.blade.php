<div>
    <h1 class="h4 text-center mb-3">Primjer uploada više PDF datoteka s pregledom</h1>
    
    {{-- Prikaz svih izabranih PDF-ova --}}
    <div class="upload_gallery d-flex flex-wrap justify-content-center gap-3 mb-0">
        @foreach ($this->documents as $document)
            <div class="img-div m-2 p-2 border">
                {{-- Prikazujemo privremeni pregled za uploadane datoteke --}}
                <embed class="image" src="{{ $document->temporaryUrl() }}" type="application/pdf" style="width:100px; height:100px;">
                <div class="text-center">
                    {{ $document->getClientOriginalName() }}
                </div>
            </div>
        @endforeach
    </div>

    {{-- Input i label za odabir datoteka --}}
    <div wire:loading wire:target="documents">Upload u toku...</div>
    <input type="file" wire:model="documents" id="pdf-upload" multiple hidden accept=".pdf">
    <label for="pdf-upload" class="btn btn-primary d-block mt-3">
        Odaberite PDF datoteke ili prevucite datoteke ovdje
    </label>
    
    {{-- Prikazivanje poruka nakon uploada --}}
    @if(session()->has('message'))
        <div class="alert alert-success mt-3">{{ session('message') }}</div>
    @endif

    {{-- JavaScript za drag and drop --}}
    <script>
        document.addEventListener('livewire:load', function () {
            const inputElement = document.getElementById('pdf-upload');
            inputElement.addEventListener('change', event => {
                @this.upload('documents', inputElement.files);
            });

            // Drag and drop
            const dropZone = document.getElementById('dropZone');
            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                dropZone.addEventListener(eventName, preventDefaults, false)
            });

            function preventDefaults(e) {
                e.preventDefault();
                e.stopPropagation();
            }
            
            ['dragenter', 'dragover'].forEach(eventName => {
                dropZone.addEventListener(eventName, () => dropZone.classList.add('highlight'), false);
            });

            ['dragleave', 'drop'].forEach(eventName => {
                dropZone.addEventListener(eventName, () => dropZone.classList.remove('highlight'), false);
            });

            dropZone.addEventListener('drop', handleDrop, false);

            function handleDrop(e) {
                let dt = e.dataTransfer;
                let files = dt.files;

                inputElement.files = files;
                @this.upload('documents', files);
            }
        });
    </script>
</div>
