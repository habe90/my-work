<div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
    <div class="dataTable-top">
        <div class="sm:flex-1 sm:flex sm:items-start flex-col">

            <div class="flex items-start flex-row mb-4 mx-3">
                @can('content_tag_delete')
                    <button class="btn btn-danger ml-3 disabled:opacity-50 disabled:cursor-not-allowed" type="button"
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
                            {{ trans('cruds.contentTag.fields.id') }}
                            @include('components.table.sort', ['field' => 'id'])
                        </th>
                        <th>
                            {{ trans('cruds.contentTag.fields.name') }}
                            @include('components.table.sort', ['field' => 'name'])
                        </th>
                        <th>
                            {{ trans('cruds.contentTag.fields.slug') }}
                            @include('components.table.sort', ['field' => 'slug'])
                        </th>
                        <th>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($contentTags as $contentTag)
                        <tr>
                            <td>
                                <input type="checkbox" value="{{ $contentTag->id }}" wire:model="selected">
                            </td>
                            <td>
                                {{ $contentTag->id }}
                            </td>
                            <td>
                                {{ $contentTag->name }}
                            </td>
                            <td>
                                {{ $contentTag->slug }}
                            </td>
                            <td>
                                <div class="flex justify-end">
                                    @can('content_tag_show')
                                        <a class="btn btn-sm btn-info mr-2"
                                            href="{{ route('admin.content-tags.show', $contentTag) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan
                                    @can('content_tag_edit')
                                        <a class="btn btn-sm btn-success mr-2"
                                            href="{{ route('admin.content-tags.edit', $contentTag) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan
                                    @can('content_tag_delete')
                                        <button class="btn btn-sm btn-rose mr-2" type="button"
                                            wire:click="confirm('delete', {{ $contentTag->id }})"
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
            {{ $contentTags->links() }}
        </div>
    </div>
    <div class="dataTable-bottom">
        <div class="dataTable-dropdown">
            Per page:
            <select wire:model="perPage" class="form-select w-full sm:w-1/6">
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
