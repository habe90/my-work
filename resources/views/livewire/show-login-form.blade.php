<div>
    <form wire:submit.prevent="login">
        <div>
            <label for="email">Email</label>
            <input type="email" wire:model="email" id="email" required>
            @error('email') <span class="error">{{ $message }}</span> @enderror
        </div>
        <div>
            <label for="password">Lozinka</label>
            <input type="password" wire:model="password" id="password" required>
            @error('password') <span class="error">{{ $message }}</span> @enderror
        </div>
        <button type="submit">Prijavi se</button>
    </form>
</div>
