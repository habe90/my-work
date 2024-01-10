<div>
    <!-- Prikaz poruka -->
    @if (session()->has('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @elseif(session()->has('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <button wire:click="sendLoginLink" class="btn btn-outline-primary btn-block mt-2" style="">
        <i class="fa fa-envelope-o fa-lg mr-1"></i> Link per E-Mail bekommen
    </button>

     {{-- Dodajte dugme koje će prikazati formu za unos lozinke --}}
     <button wire:click="togglePasswordForm" class="btn btn-outline-primary btn-block mt-2">
        <i class="fa fa-lock fa-lg mr-1"></i> Passwort eingeben
    </button>

      {{-- Forma za unos lozinke --}}
      @if ($showPasswordForm)
      <form wire:submit.prevent="loginWithPassword">
        <div class="form-group">
            <label for="password">E-mail</label>
            <input wire:model="email" type="email" class="form-control" name="email" id="email" placeholder="E-mail Address">
        </div>
          <div class="form-group">
              <label for="password">Kennwort</label>
              <input wire:model="password" type="password" class="form-control" id="password" placeholder="Kennwort eingeben">
          </div>
          <button type="submit" class="btn btn-primary">Anmelden</button>
      </form>
  @endif

</div>
