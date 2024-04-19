<div>
    <h1 class="h4 text-center mb-3">Upload više PDF datoteka</h1>
    
    <form wire:submit.prevent="uploadDocuments">
        <input type="file" wire:model="documents" id="pdf-upload" multiple accept=".pdf">
        <label for="pdf-upload" class="btn btn-primary d-block mt-3">Odaberite PDF datoteke</label>
        
        <div class="d-flex flex-wrap justify-content-center gap-3 mt-3">
            @foreach ($this->documents as $document)
                <div class="p-2 border" wire:key="document-{{ $loop->index }}">
                    {{-- Prikazujemo ime fajla, jer ne možemo prikazati PDF --}}
                    {{ $document->getClientOriginalName() }}
                </div>
            @endforeach
        </div>
        
        @error('documents.*')
            <div class="alert alert-danger mt-3">{{ $message }}</div>
        @enderror

        @if ($this->documents)
            <button type="submit" class="btn btn-success mt-3">Pošalji dokumente</button>
        @endif
    </form>
    
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
