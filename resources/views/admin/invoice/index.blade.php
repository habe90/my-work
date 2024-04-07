@extends('layouts.admin')
@section('content')
    <div class="animate__animated p-6" :class="[$store.app.animation]">
        <div>
            <div class="panel flex items-center overflow-x-auto whitespace-nowrap p-3 text-primary">

                @can('content_page_create')
                    <a class="btn btn-primary getMyFormModal" href="{{ route('admin.content-pages.create') }}"
                    data-title="{{ __('global.add_invoice') }}"
                    data-url="{{ route('admin.form.getMyForm') }}"
                    data-form-name="{{ encrypt('Add Inovice') }}"
                    data-id="{{ encrypt('0') }}">
                        {{ trans('global.add_invoice') }} 
                    </a>
                @endcan

            </div>
            <div class="panel mt-6">
                @livewire('invoices-table')
            </div>

            {{-- Uputstvo za Cron naredbu --}}
            <div class="mt-6">
                
                <h3 class="text-lg font-medium leading-6 text-gray-900">{{ __('global.instruction') }}</h3>
                <p class="mt-1 text-sm text-gray-600">{{ __('global.description') }}</p>
                <pre class="bg-gray-100 rounded-md p-4 mt-2"><code>{{ __('global.command') }}</code></pre>


                <h3 class="text-lg font-medium leading-6 text-gray-900 mt-4">{{ __('global.last_cron_run') }}</h3>
                <p class="mt-1 text-sm text-gray-600">
                    {{ __('global.last_cron_run_at') }}: 
                    {{ Cache::get('last_cron_run', __('global.not_run_yet')) }}
                </p>

            </div>
        </div>
    </div>
@endsection
