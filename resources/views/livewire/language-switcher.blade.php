<div class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="languageDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
        <img src="/frontend/img/{{ $currentLanguage }}.png" alt="{{ $currentLanguage }}" style="width: 20px;"> 
        <!-- Ovdje možete izostaviti prikaz trenutnog jezika ako već prikazujete zastavu -->
    </a>
    <div class="dropdown-menu" aria-labelledby="languageDropdown">
        @foreach($languages as $language)
            <a class="dropdown-item" href="#" 
               onclick="event.preventDefault(); changeLocale('{{ $language['short_code'] }}')">
                <img src="/frontend/img/{{ $language['short_code'] }}.png" alt="{{ $language['title'] }}" style="width: 20px;"> 
                {{ $language['title'] }}
            </a>
        @endforeach
    </div>
</div>

<script>
    function changeLocale(locale) {
        @this.changeLocale(locale);
        window.location.reload(); // Osvježava stranicu da bi se promjene odrazile
    }
</script>
