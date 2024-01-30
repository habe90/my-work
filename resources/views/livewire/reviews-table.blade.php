<div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
    <div class="overflow-hidden">
        <div class="overflow-x-auto">
            <table class="table table-index w-full">
                <thead>
                    <tr>
                        <th class="w-9">
                        </th>
                        <th class="w-28">
                            {{ trans('cruds.reviews.id') }}

                        </th>
                        <th>
                            {{ trans('cruds.reviews.title') }}

                        </th>
                        <th>
                            {{ trans('cruds.reviews.image') }}

                        </th>
                        <th>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reviews as $review)
                        <tr>
                            <td>
                                <input type="checkbox" value="{{ $review->id }}" wire:model="selected">
                            </td>
                            <td>
                                {{ $review->id }}
                            </td>
                            <td>
                                {{ $review->name }}
                            </td>
                            <td>
                                <img src="{{ $review->image }}" height="100" width="100" alt="">
                            </td>
                            <td>
                                <div class="flex justify-end">
                                    @can('permission_show')
                                        <a class="btn btn-sm btn-info mr-2"
                                            href="{{ route('admin.mywork.reviews.show', $review) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan
                                    @can('permission_edit')
                                        <a class="btn btn-sm btn-success mr-2 getMyFormModal"
                                            data-title="{{ __('cruds.reviews.edit_review') }}"
                                            data-url="{{ route('admin.form.getMyForm') }}"
                                            data-form-name="{{ encrypt('Add review') }}"
                                            data-id="{{ encrypt($review->id) }}">
                                            <i class='bx bx-pencil'></i> {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    <button class="btn btn-sm btn-rose mr-2" type="button"
                                        wire:click="$emit('delete', {{ $review->id }})" wire:loading.attr="disabled">
                                        {{ trans('global.delete') }}
                                    </button>

                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">No reviews found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <!-- ... -->
    <div class="card-body">
        <div class="pt-3">

            {{ $reviews->links() }}
        </div>
    </div>
</div>

@push('scripts')
    <script>
        Livewire.on('delete', id => {
            if (confirm("{{ trans('global.areYouSure') }}")) {
                Livewire.emit('deleteConfirmed', id);
            }
        });
    </script>
@endpush
