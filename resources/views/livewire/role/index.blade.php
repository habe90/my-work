<div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
    <div class="dataTable-top">


        @can('role_delete')
            <button class="btn btn-rose ml-3 disabled:opacity-50 disabled:cursor-not-allowed" type="button"
                wire:click="confirm('deleteSelected')" wire:loading.attr="disabled"
                {{ $this->selectedCount ? '' : 'disabled' }}>
                {{ __('Delete Selected') }}
            </button>
        @endcan
        <div class="md:absolute md:top-5 ltr:md:left-5 rtl:md:right-5">
            <div class="mb-5 flex flex-wrap items-center ">
                @if (file_exists(app_path('Http/Livewire/ExcelExport.php')))
                    <livewire:excel-export model="Role" format="csv" />
                    <livewire:excel-export model="Role" format="xlsx" />
                    <livewire:excel-export model="Role" format="pdf" />
                @endif
            </div>
        </div>

        <div class="dataTable-search">
            Search:
            <input type="text" wire:model.debounce.300ms="search" class="dataTable-input" />
        </div>

    </div>


    <div wire:loading.delay>
        Loading...
    </div>

    <div class="dataTable-container">

            <table class="table dataTable-table w-full table-hover" id="myTable">
                <thead>
                    <tr>
                        <th class="w-9">
                        </th>
                        <th class="w-28" data-sortable>
                            {{ trans('cruds.role.fields.id') }}
                            @include('components.table.sort', ['field' => 'id'])
                        </th>
                        <th data-sortable>
                            {{ trans('cruds.role.fields.title') }}
                            @include('components.table.sort', ['field' => 'title'])
                        </th>
                        <th class="text-black" data-sortable>
                            {{ trans('cruds.role.fields.permissions') }}
                        </th>
                        <th>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($roles as $role)
                        <tr>
                            <td>
                                <input type="checkbox" value="{{ $role->id }}" wire:model="selected">
                            </td>
                            <td>
                                {{ $role->id }}
                            </td>
                            <td>
                                {{ $role->title }}
                            </td>
                            <td>
                                @foreach ($role->permissions as $key => $entry)
                                    <span class="badge badge-relationship text-black">{{ $entry->title }}</span>
                                @endforeach
                            </td>
                            <td>
                                <div class="flex justify-end">
                                    @can('role_show')
                                        <a class="btn btn-sm btn-info mr-2" href="{{ route('admin.roles.show', $role) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan
                                    @can('role_edit')
                                        <a class="btn btn-sm btn-success mr-2"
                                            href="{{ route('admin.roles.edit', $role) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan
                                    @can('role_delete')
                                        <button class="btn btn-sm btn-rose mr-2" type="button"
                                            wire:click="confirm('delete', {{ $role->id }})"
                                            wire:loading.attr="disabled">
                                            {{ trans('global.delete') }}
                                        </button>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr class="text-center">
                            <td colspan="10" >No entries found.</td>
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
        @if ($this->selectedCount)
            <p class="text-sm leading-5">
                <span class="font-medium">
                    {{ $this->selectedCount }}
                </span>
                {{ __('Entries selected') }}
            </p>
        @endif
        {{ $roles->links() }}
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
