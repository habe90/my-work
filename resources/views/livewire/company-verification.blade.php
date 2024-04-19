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
<style>
    .upload_dropZone {
  color: #0f3c4b;
  background-color: var(--colorPrimaryPale, #c8dadf);
  outline: 2px dashed var(--colorPrimaryHalf, #c1ddef);
  outline-offset: -12px;
  transition:
    outline-offset 0.2s ease-out,
    outline-color 0.3s ease-in-out,
    background-color 0.2s ease-out;
}
.upload_dropZone.highlight {
  outline-offset: -4px;
  outline-color: var(--colorPrimaryNormal, #0576bd);
  background-color: var(--colorPrimaryEighth, #c8dadf);
}
.upload_svg {
  fill: var(--colorPrimaryNormal, #0576bd);
}
.btn-upload {
  color: #fff;
  background-color: var(--colorPrimaryNormal);
}
.btn-upload:hover,
.btn-upload:focus {
  color: #fff;
  background-color: var(--colorPrimaryGlare);
}
.upload_img {
  width: calc(33.333% - (2rem / 3));
  object-fit: contain;
}
</style>