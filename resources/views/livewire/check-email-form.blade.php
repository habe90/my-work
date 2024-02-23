<div>
    <div class="form-group">
        <input type="email" class="form-control" wire:model.lazy="email" placeholder="Email">
        @error('email') <span class="error" style="color:red;">{{ $message }}</span> @enderror
    </div>

    @if ($userExists)
        <div class="form-group">
            <input type="password" class="form-control" wire:model.lazy="password" placeholder="Password">
            @error('password') <span class="error mt-2" style="color:red;">{{ $message }}</span> @enderror
        </div>
    @endif

    @if (session()->has('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="form-group">
        <button wire:click="checkUser" class="btn dark-2 btn-md btn-block">{{ $userExists ? 'Login' : 'Weiter' }}</button>
    </div>
</div>
