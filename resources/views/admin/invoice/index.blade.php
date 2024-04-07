@extends('layouts.admin')
@section('content')
    <div class="animate__animated p-6" :class="[$store.app.animation]">
        <div>
            <div class="panel flex items-center overflow-x-auto whitespace-nowrap p-3 text-primary">

                @can('content_page_create')
                    <a class="btn btn-primary getMyFormModal" href="{{ route('admin.content-pages.create') }}"
                    data-title="{{ __('global.add_inovice') }}"
                    data-url="{{ route('admin.form.getMyForm') }}"
                    data-form-name="{{ encrypt('Add Inovice') }}"
                    data-id="{{ encrypt('0') }}">
                        {{ trans('global.add_inovice') }} 
                    </a>
                @endcan

            </div>
            <div class="panel mt-6">
                @livewire('invoices-table')
            </div>

            {{-- Uputstvo za Cron naredbu --}}
            <div class="mt-6">
                
                <h3 class="text-lg font-medium leading-6 text-gray-900">Anleitung für den Cron-Befehl</h3>
                <p class="mt-1 text-sm text-gray-600">Verwenden Sie diesen Cron-Befehl, um den Task für die Generierung von Rechnungen automatisch am letzten Tag jedes Monats um 17:00 Uhr auszuführen.</p>
                <pre class="bg-gray-100 rounded-md p-4 mt-2"><code>0 17 * * * cd /pfad-zu-ihrem-projekt && php artisan schedule:run >> /dev/null 2>&1</code></pre>

                <h3 class="text-lg font-medium leading-6 text-gray-900 mt-4">{{ __('global.last_cron_run') }}</h3>
                <p class="mt-1 text-sm text-gray-600">
                    {{ __('global.last_cron_run_at') }}: 
                    {{ Cache::get('last_cron_run', __('global.not_run_yet')) }}
                </p>

            </div>
        </div>
    </div>
@endsection
