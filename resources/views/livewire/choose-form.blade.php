<div>
    @switch($categoryName)
        @case('dolorem')
            @livewire('home-renovation-form')
            @break

        @case('Diagnosis of electrical systems')
            @livewire('home-renovation-form')
            @break


        {{-- Nastavite sa ostalim kategorijama --}}

        @default
            <p>Nema formulara za odabranu kategoriju.</p>
    @endswitch
</div>
