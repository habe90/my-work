    <div>
        <form wire:submit.prevent="updateProfileInformation"
            class="mb-5 rounded-md border border-[#ebedf2] bg-white p-4 dark:border-[#191e3a] dark:bg-[#0e1726]">
            <h6 class="mb-5 text-lg font-bold"> {{ __('global.profile_information') }}</h6>
            <div class="flex flex-col sm:flex-row">
                <div class="mb-5 w-full sm:w-2/12 ltr:sm:mr-4 rtl:sm:ml-4">
                    <img src="{{ asset('assets/images/profile-34.jpeg') }}" alt="image"
                        class="mx-auto h-20 w-20 rounded-full object-cover md:h-32 md:w-32">
                </div>
                <div class="grid flex-1 grid-cols-1 gap-5 sm:grid-cols-2"> 
                <div class="form-group px-4">
                    <label class="form-label" for="name">{{ __('global.user_name') }}</label>
                    <input class="form-input" id="name" type="text" wire:model.defer="state.name"
                        autocomplete="name">
                    @error('state.name')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group px-4">
                    <label class="form-label" for="email">{{ __('global.login_email') }}</label>
                    <input class="form-input" id="email" type="text" wire:model.defer="state.email"
                        autocomplete="email">
                    @error('state.email')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group px-4 flex items-center">
                    <button class="btn btn-indigo mr-3">
                        {{ __('global.save') }}
                    </button>

                    <div x-data="{ shown: false, timeout: null }" x-init="@this.on('saved', () => { clearTimeout(timeout);
                        shown = true;
                        timeout = setTimeout(() => { shown = false }, 2000); })"
                        x-show.transition.out.opacity.duration.1500ms="shown" x-transition:leave.opacity.duration.1500ms
                        class="mt-3 sm:col-span-2" style="display: none;">
                        {{ __('global.saved') }}
                    </div>

                </div>
            </div>
        </div>
        </form>
    </div>
