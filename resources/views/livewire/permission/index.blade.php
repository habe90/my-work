<div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
    {{-- Kreiranje 2 reda i kolonu radi estetike --}}
    <div class="dataTable-top">
        <div class="sm:flex-1 sm:flex sm:items-start flex-col">
            <!-- Drugi red -->
            <div class="flex items-start flex-row mb-4 mx-3">
                <!-- Kolona 1 u redu 2 -->
                <div class="flex-initial mr-3">
                    @can('permission_delete')
                        <button class="btn btn-rose disabled:opacity-50 disabled:cursor-not-allowed" type="button" wire:click="confirm('deleteSelected')" wire:loading.attr="disabled" {{ $this->selectedCount ? '' : 'disabled' }}>
                            {{ __('Delete Selected') }}
                        </button>
                    @endcan
                </div>
                <!--Kolona 2 u redu 2 -->
                <div class="dataTable-search">
                    Search:
                    <input type="text" wire:model.debounce.300ms="search" class="dataTable-input" />
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
                            {{ trans('cruds.permission.fields.id') }}
                            @include('components.table.sort', ['field' => 'id'])
                        </th>
                        <th>
                            {{ trans('cruds.permission.fields.title') }}
                            @include('components.table.sort', ['field' => 'title'])
                        </th>
                        <th>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($permissions as $permission)
                        <tr>
                            <td>
                                <input type="checkbox" value="{{ $permission->id }}" wire:model="selected">
                            </td>
                            <td>
                                {{ $permission->id }}
                            </td>
                            <td>
                                {{ $permission->title }}
                            </td>
                            <td>
                                <div class="flex justify-end">
                                    @can('permission_show')
                                        <a class="btn btn-sm btn-info mr-2" href="{{ route('admin.permissions.show', $permission) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan
                                    @can('permission_edit')
                                        <a class="btn btn-sm btn-success mr-2" href="{{ route('admin.permissions.edit', $permission) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan
                                    @can('permission_delete')
                                        <button class="btn btn-sm btn-rose mr-2" type="button" wire:click="confirm('delete', {{ $permission->id }})" wire:loading.attr="disabled">
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

    <div class="card-body">
        <div class="pt-3">
            @if($this->selectedCount)
                <p class="text-sm leading-5">
                    <span class="font-medium">
                        {{ $this->selectedCount }}
                    </span>
                    {{ __('Entries selected') }}
                </p>
            @endif
            {{ $permissions->links() }}
        </div>
    </div>
</div>

@push('scripts')
    <script>
        Livewire.on('confirm', e => {
            if (!confirm("{{ trans('global.areYouSure') }}")) {
                return;
            }
            @this[e.callback](...e.argv);
        })
    </script>
@endpush