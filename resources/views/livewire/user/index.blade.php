<div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
    {{-- Kreiranje 2 reda i kolonu radi estetike --}}
    <div class="dataTable-top">


        @can('role_delete')
            <button class="btn btn-rose ml-3 disabled:opacity-50 disabled:cursor-not-allowed" type="button"
                wire:click="confirm('deleteSelected')" wire:loading.attr="disabled"
                {{ $this->selectedCount ? '' : 'disabled' }}>
                {{ __('Delete Selected') }}
            </button>
        @endcan

        <div class="dataTable-search">
            Search:
            <input type="text" wire:model.debounce.300ms="search" class="dataTable-input" />
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
    <div class="dataTable-bottom">
        <div class="dataTable-dropdown">
            Per page:
            <select wire:model="perPage" class="dataTable-selector">
                @foreach ($paginationOptions as $value)
                    <option value="{{ $value }}">{{ $value }}</option>
                @endforeach
            </select>
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
