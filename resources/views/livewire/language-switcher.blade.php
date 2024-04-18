<div class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="languageDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
        {{ $currentLanguage }}
    </a>
    <div class="dropdown-menu" aria-labelledby="languageDropdown">
        @foreach($languages as $language)
            <a class="dropdown-item" wire:click="changeLocale('{{ $language['short_code'] }}')" href="#">
                {{ $language['title'] }}
            </a>
        @endforeach
    </div>
</div>
