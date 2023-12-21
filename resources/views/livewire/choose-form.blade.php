<div>
    @switch($categoryName)
        @case('dolorem')
            @livewire('home-renovation-form')
            @break

        @case('Keramika')
            @livewire('keramika-form')
            @break

            

        {{-- Nastavite sa ostalim kategorijama --}}

        @default
            <p>Nema formulara za odabranu kategoriju.</p>
    @endswitch
</div>
