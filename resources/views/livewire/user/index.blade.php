<div>
    {{-- Kreiranje 2 reda i kolonu radi estetike --}}
    <div class="card-controls sm:flex sm:items-center mb-3">
        <div class="sm:flex-1 sm:flex sm:items-start flex-col">

            <!-- Prvi Red -->
            <div class="flex items-start flex-row my-3 mx-3">
                <!-- Kolona 1 u redu 1 -->
                <div class="flex-initial mr-3">
                    <span class="ml-3">Per Page: </span>
                    <select wire:model="perPage" class="form-select ml-2">
                        @foreach ($paginationOptions as $value)
                            <option class="font-normal" value="{{ $value }}">{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
                <!-- Kolona 2 u redu 1 -->
                <div class="sm:flex-1 sm:text-right flex-initial">
                    <span class="block">Search: </span>
                    <input type="text" wire:model.debounce.300ms="search" class="form-input w-52 border-black p-2" />
                </div>

            </div>

            <!-- Drugi red -->
            <div class="flex items-start flex-row mb-4 mx-3">
                <!-- Kolona 1 u redu 2 -->
                <div class="flex-initial mr-3">
                    @can('permission_delete')
                        <button class="btn btn-rose disabled:opacity-50 disabled:cursor-not-allowed" type="button"
                            wire:click="confirm('deleteSelected')" wire:loading.attr="disabled"
                            {{ $this->selectedCount ? '' : 'disabled' }}>
                            {{ __('Delete Selected') }}
                        </button>
                    @endcan
                </div>
                <!--Kolona 2 u redu 2 -->
                <div class="flex items-center space-x-2 flex-initial">
                    @if (file_exists(app_path('Http/Livewire/ExcelExport.php')))
                        <livewire:excel-export model="Permission" format="csv" />
                        <livewire:excel-export model="Permission" format="xlsx" />
                        <livewire:excel-export model="Permission" format="pdf" />
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div wire:loading.delay>
        Loading...
    </div>

    <div class="overflow-hidden">
        <div class="overflow-x-auto">
            <table class="table table-index w-full">
                <thead>
                    <tr>
                        <th class="w-9">
                        </th>
                        <th class="w-28">
                            {{ trans('cruds.user.fields.id') }}
                            @include('components.table.sort', ['field' => 'id'])
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.name') }}
                            @include('components.table.sort', ['field' => 'name'])
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.address') }}
                            @include('components.table.sort', ['field' => 'address'])
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.phone') }}
                            @include('components.table.sort', ['field' => 'phone'])
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.email') }}
                            @include('components.table.sort', ['field' => 'email'])
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.email_verified_at') }}
                            @include('components.table.sort', ['field' => 'email_verified_at'])
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.roles') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.locale') }}
                            @include('components.table.sort', ['field' => 'locale'])
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.user_type') }}
                            @include('components.table.sort', ['field' => 'user_type'])
                        </th>
                        <th>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td>
                                <input type="checkbox" value="{{ $user->id }}" wire:model="selected">
                            </td>
                            <td>
                                {{ $user->id }}
                            </td>
                            <td>
                                {{ $user->name }}
                            </td>
                            <td>
                                {{ $user->address }}
                            </td>
                            <td>
                                {{ $user->phone }}
                            </td>
                            <td>
                                <a class="link-light-blue" href="mailto:{{ $user->email }}">
                                    <i class="far fa-envelope fa-fw">
                                    </i>
                                    {{ $user->email }}
                                </a>
                            </td>
                            <td>
                                {{ $user->email_verified_at }}
                            </td>
                            <td>
                                @foreach ($user->roles as $key => $entry)
                                    <span class="badge badge-relationship">{{ $entry->title }}</span>
                                @endforeach
                            </td>
                            <td>
                                {{ $user->locale }}
                            </td>
                            <td>
                                {{ $user->user_type }}
                            </td>
                            <td>
                                <div class="flex justify-end">
                                    @can('user_show')
                                        <a class="btn btn-sm btn-info mr-2" href="{{ route('admin.users.show', $user) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan
                                    @can('user_edit')
                                        <a class="btn btn-sm btn-success mr-2"
                                            href="{{ route('admin.users.edit', $user) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan
                                    @can('user_delete')
                                        <button class="btn btn-sm btn-rose mr-2" type="button"
                                            wire:click="confirm('delete', {{ $user->id }})"
                                            wire:loading.attr="disabled">
                                            {{ trans('global.delete') }}
                                        </button>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10">No entries found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="card-body">
        <div class="pt-3">
            @if ($this->selectedCount)
                <p class="text-sm leading-5">
                    <span class="font-medium">
                        {{ $this->selectedCount }}
                    </span>
                    {{ __('Entries selected') }}
                </p>
            @endif
            {{ $users->links() }}
        </div>
    </div>
</div>

@push('scripts')
    <script>
        Livewire.on('confirm', e => {
            if (!confirm("{{ trans('global.areYouSure') }}")) {
                return
            }
            @this[e.callback](...e.argv)
        })
    </script>
@endpush
