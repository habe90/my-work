@extends('layouts.admin')
@section('content')
    <div class="animate__animated p-6" :class="[$store.app.animation]">
        <div>
            <div class="panel flex items-center overflow-x-auto whitespace-nowrap p-3 text-primary">

                @can('content_page_create')
                    <a class="btn btn-primary getMyFormModal" href="{{ route('admin.content-pages.create') }}"
                    data-title="{{ __('global.add_job') }}"
                    data-url="{{ route('admin.form.getMyForm') }}"
                    data-form-name="{{ encrypt('Add Job') }}"
                    data-id="{{ encrypt('0') }}">
                    
                        {{ trans('global.add') }} {{ trans('cruds.contentPage.title_singular') }}
                    </a>
                @endcan

            </div>
            <div class="panel mt-6">
                @livewire('jobs.jobs-table')

            </div>
        </div>
    </div>
@endsection
