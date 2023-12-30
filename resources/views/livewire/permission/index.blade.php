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
                        @foreach($paginationOptions as $value)
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
                        <button class="btn btn-rose disabled:opacity-50 disabled:cursor-not-allowed" type="button" wire:click="confirm('deleteSelected')" wire:loading.attr="disabled" {{ $this->selectedCount ? '' : 'disabled' }}>
                            {{ __('Delete Selected') }}
                        </button>
                    @endcan
                </div>
                <!--Kolona 2 u redu 2 -->
                <div class="flex items-center space-x-2 flex-initial">
                    @if(file_exists(app_path('Http/Livewire/ExcelExport.php')))
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