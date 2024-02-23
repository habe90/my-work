<div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
    <div class="overflow-hidden">
        <div class="overflow-x-auto">
            <table class="table table-index w-full">
                <thead>
                    <tr>
                        <th class="w-9">
                        </th>
                        <th class="w-28">
                            {{ trans('cruds.ads.id') }}

                        </th>
                        <th>
                            {{ trans('cruds.ads.name') }}

                        </th>
                        <th>
                            {{ trans('cruds.ads.image') }}

                        </th>
                        <th>
                            {{ trans('cruds.ads.details') }}

                        </th>
                        
                        <th>
                            {{ trans('cruds.ads.price') }}

                        </th>
                        <th>
                            {{ trans('cruds.ads.status') }}

                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($ads as $ad) 
                        <tr>
                            <td>
                                <input type="checkbox" value="{{ $ad->id }}" wire:model="selected">
                            </td>
                            <td>
                                {{ $ad->id }}
                            </td>
                            <td>
                                {{ $ad->company_name }}
                            </td>
                            <td>
                                <img src="{{ $ad->logo }}" height="100" width="100" alt=""> 
                            </td>
                            <td>
                                {{ $ad->offer_details }}
                            </td>
                            <td>
                                {{ $ad->ad_price }}
                            </td>
                            <td>
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $ad->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $ad->is_active ? 'Aktiv' : 'Nicht aktiv' }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">Keine Anzeigen gefunden.</td>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <!-- ... -->
    <div class="card-body">
        <div class="pt-3">

            {{ $ads->links() }}
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
