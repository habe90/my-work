<div class="row justify-content-center">
    <div class="col-lg-8 col-md-10 col-sm-12">
        <div class="banner-search style-1 position-relative">
            <div class="input-group">
                <input wire:model="searchTerm" wire:keydown.enter="performSearch" type="text"
                    class="form-control lio-rad" placeholder="{{__('global.searchPlaceholder')}}">
                <div class="input-group-append">
                    <button wire:click="$refresh" class="btn bt-round btn--2"><i class="ti-search"></i></button>
                </div>
            </div>
            @if (strlen($searchTerm) > 2)
                <div class="list-group position-absolute w-100" style="z-index: 1000; top: 100%;">
                    @if ($showDropdown)
                        <!-- Prikazuje se samo ako je showDropdown true -->
                        @forelse($searchResults as $category)
                            <a href="#" class="list-group-item list-group-item-action text-left"
                                style="font-weight: bold;" wire:mouseover="highlightResult"
                                wire:click="selectCategory({{ $category->id }})">
                                {{ $category->name }}
                            </a>

                        @empty
                            <div class="list-group-item">Nicht für den Preis geeignet.</div>
                        @endforelse
                    @endif
                </div>
            @endif
        </div>
    </div>
</div>

<script>
    document.addEventListener('livewire:load', function() {
        Livewire.on('close-dropdown', () => {
            setTimeout(() => {
                @this.set('showDropdown', false);
            }, 5000); // Promijenite 5000 u željeni broj milisekundi
        });

        Livewire.on('highlightResult', () => {
            // Dodajte CSS stil za hover efekat i boldiranje ovde
        });

        Livewire.on('categorySelected', (data) => {
        var categoryId = data.categoryId;
        console.log('Odabrana kategorija: ' + categoryId);
        
        // Ovdje dodajte logiku koja će se izvršiti kada se događaj uhvati
        // Na primjer, preusmjeravanje na drugu stranicu ili ažuriranje UI
    });
    });

</script>
