<div class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="languageDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
        <img src="/frontend/img/{{ $currentLanguage }}.png" alt="{{ $languages[$currentLanguage]['title'] ?? $currentLanguage }}" style="width: 20px;"> 
        {{-- Prikaz trenutnog jezika može biti samo ime jezika ili možete koristiti zastavu --}}
    </a>
    <div class="dropdown-menu" aria-labelledby="languageDropdown">
        @foreach($languages as $language)
            <a class="dropdown-item" wire:click.prevent="changeLocale('{{ $language['short_code'] }}')" href="#">
                <img src="/frontend/img/{{ $language['short_code'] }}.png" alt="{{ $language['title'] }}" style="width: 20px;"> 
                {{ $language['title'] }}
            </a>
        @endforeach
    </div>
</div>


<script>
    document.addEventListener('livewire:load', function () {
        window.livewire.on('localeChanged', function () {
            window.location.reload();
        });
    });
</script>

