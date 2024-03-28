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

            {{-- Uputstvo za Cron komandu --}}
            <div class="mt-6">
                <h3 class="text-lg font-medium leading-6 text-gray-900">Uputstvo za Cron komandu</h3>
                <p class="mt-1 text-sm text-gray-600">Koristite ovu Cron komandu da automatski pokrenete zadatak generisanja faktura na poslednji dan svakog mjeseca u 17:00 sati.</p>
                <pre class="bg-gray-100 rounded-md p-4 mt-2"><code>0 17 * * * cd /putanja-do-vasheg-projekta && php artisan schedule:run >> /dev/null 2>&1</code></pre>
            </div>
        </div>
    </div>
@endsection
