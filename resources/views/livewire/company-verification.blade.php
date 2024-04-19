<div>
    <h1 class="h4 text-center mb-3">Upload više PDF datoteka</h1>
    
    <div class="d-flex justify-content-center">
        <div wire:loading wire:target="documents">Učitavanje...</div>
        <input type="file" wire:model="documents" id="pdf-upload" multiple hidden accept="application/pdf">
        <label for="pdf-upload" class="btn btn-primary d-block mt-3 text-black">
            Odaberite PDF datoteke ili prevucite datoteke ovdje
        </label>
    </div>

    <div class="d-flex flex-column align-items-center mt-3">
        @foreach ($this->documents as $document)
            <div class="uploaded-file d-flex align-items-center justify-content-between p-2 border mb-2">
                <span>{{ $document->getClientOriginalName() }}</span>
                <span class="text-success">&#10003;</span>
            </div>
        @endforeach
    </div>

    @if ($this->documents)
        <div class="d-flex justify-content-center">
            <button wire:click="uploadDocuments" class="btn btn-success mt-3">Pošalji dokumente</button>
        </div>
    @endif

    @if (session()->has('message'))
        <div class="alert alert-success mt-3">{{ session('message') }}</div>
    @endif

    {{-- JavaScript za drag and drop --}}
    <script>
        document.addEventListener('livewire:load', function() {
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
    <style>
        .upload-dropzone {
            display: block;
            /* Ili flex ako želite centrirati sadržaj */
            width: 100%;
            /* Prilagodite prema potrebi */
            padding: 10px;
            border: 2px dashed #ccc;
            /* Stil za dashed border */
            text-align: center;
            cursor: pointer;
            background-color: #f8f9fa;
            /* Svijetla pozadinska boja */
            transition: background-color 0.3s;
        }

        .upload-dropzone:hover,
        .upload-dropzone:focus {
            background-color: #e9ecef;
            /* Tamnija pozadinska boja pri hoveru */
        }

        .uploaded-file {
            background-color: #fff;
            /* Bijela pozadinska boja za fajlove */
            border-radius: 4px;
            /* Zaobljeni uglovi */
            margin-bottom: 8px;
            /* Razmak između fajlova */
            padding: 8px 12px;
            /* Unutrašnji razmak */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            /* Sjena za fajlove */
            transition: transform 0.2s;
            /* Animacija za hover efekt */
        }

        .uploaded-file:hover {
            transform: translateY(-2px);
            /* Pomaknite fajl za 2px pri hoveru */
        }

        /* Dodajte ovo ako želite vizualno odvojiti uploadanu galeriju od ostatka sadržaja */
        .upload_gallery {
            border-top: 2px solid #dee2e6;
            /* Linija iznad galerije */
            padding-top: 16px;
            /* Razmak iznad prve uploadane datoteke */
        }
    </style>
</div>
