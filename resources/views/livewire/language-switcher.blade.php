<div class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="languageDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
        <img src="/path/to/flags/{{ $currentLanguage }}.png" alt="{{ $currentLanguage }}" style="width: 20px;"> 
        {{ $currentLanguage }}
    </a>
    <div class="dropdown-menu" aria-labelledby="languageDropdown">
        @foreach($languages as $language)
            <a class="dropdown-item" wire:click="changeLocale('{{ $language['short_code'] }}')" href="#">
                <img src="/path/to/flags/{{ $language['short_code'] }}.png" alt="{{ $language['title'] }}" style="width: 20px;"> 
                {{ $language['title'] }}
            </a>
        @endforeach
    </div>
</div>
