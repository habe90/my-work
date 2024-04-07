<div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
    <div class="dataTable-top">
        <div class="sm:flex-1 sm:flex sm:items-start flex-col">
            <!-- Drugi red -->
            <div class="flex items-start flex-row mb-4 mx-3">
                <!-- Kolona 1 u redu 2 -->
                <div class="flex-initial mr-3">
                    @can('content_page_delete')
                        <button class="btn btn-danger ml-3 disabled:opacity-50 disabled:cursor-not-allowed" type="button"
                            wire:click="confirm('deleteSelected')" wire:loading.attr="disabled"
                            {{ $this->selectedCount ? '' : 'disabled' }}>
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
                            {{ trans('cruds.contentPage.fields.id') }}
                            @include('components.table.sort', ['field' => 'id'])
                        </th>
                        <th>
                            {{ trans('cruds.contentPage.fields.title') }}
                            @include('components.table.sort', ['field' => 'title'])
                        </th>
                        <th>
                            {{ trans('cruds.contentPage.fields.active') }}
                        </th>
                        <th>
                            {{ trans('cruds.contentPage.fields.category') }}
                        </th>
                        <th>
                            {{ trans('cruds.contentPage.fields.tag') }}
                        </th>
                        <th>
                            {{ trans('cruds.contentPage.fields.excerpt') }}
                            @include('components.table.sort', ['field' => 'excerpt'])
                        </th>
                        <th>
                            {{ trans('cruds.contentPage.fields.featured_image') }}
                        </th>
                        <th>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($contentPages as $contentPage)
                        <tr>
                            <td>
                                <input type="checkbox" value="{{ $contentPage->id }}" wire:model="selected">
                            </td>
                            <td>
                                {{ $contentPage->id }}
                            </td>
                            <td>
                                {{ $contentPage->title }}
                            </td>
                            <td>
                                <label class="relative h-6 w-12">
                                    <input type="checkbox" class="custom_switch peer absolute top-0 z-10 h-full w-full cursor-pointer opacity-0 ltr:left-0 rtl:right-0" {{ $contentPage->active ? 'checked' : '' }} wire:click="toggleActive({{ $contentPage->id }})">
                                    <span class="outline_checkbox bg-icon block h-full rounded-full border-2 border-[#ebedf2] before:absolute before:bottom-1 before:h-4 before:w-4 before:rounded-full before:bg-[#ebedf2] before:bg-[url('{{ asset('images/close.svg') }}')] before:bg-center before:bg-no-repeat before:transition-all before:duration-300 peer-checked:border-primary peer-checked:before:bg-primary peer-checked:before:bg-[url('{{ asset('images/checked.svg') }}')] ltr:before:left-1 ltr:peer-checked:before:left-7 rtl:before:right-1 rtl:peer-checked:before:right-7 dark:border-white-dark dark:before:bg-white-dark">
                                    </span>
                                </label>
                            </td>
                            
                            
                            
                            <td>
                                @foreach ($contentPage->category as $key => $entry)
                                    <span class="badge badge-relationship">{{ $entry->name }}</span>
                                @endforeach
                            </td>
                            <td>
                                @foreach ($contentPage->tag as $key => $entry)
                                    <span class="badge badge-relationship">{{ $entry->name }}</span>
                                @endforeach
                            </td>
                            <td>
                                {{ $contentPage->excerpt }}
                            </td>
                            <td>
                                @foreach ($contentPage->featured_image as $key => $entry)
                                    <a class="link-photo" href="{{ $entry['url'] }}">
                                        <img src="{{ $entry['thumbnail'] }}" alt="{{ $entry['name'] }}"
                                            title="{{ $entry['name'] }}">
                                    </a>
                                @endforeach
                            </td>
                            <td>
                                <div class="flex justify-end">
                                    @can('content_page_show')
                                    <a class="btn btn-sm btn-info mr-2" href="{{ url('/page/' . $contentPage->slug) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan
                                
                                    @can('content_page_edit')
                                    <a class="btn btn-sm btn-success mr-2" href="{{ route('admin.content-pages.edit', $contentPage) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                    @endcan
                                    @can('content_page_delete')
                                        <button class="btn btn-sm btn-danger mr-2" type="button"
                                            wire:click="confirm('delete', {{ $contentPage->id }})"
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
            {{ $contentPages->links() }}
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
