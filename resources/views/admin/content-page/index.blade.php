@extends('layouts.admin')
@section('content')
    <div class="animate__animated p-6" :class="[$store.app.animation]">
        <div x-data="exportTable">
            <div class="panel flex items-center overflow-x-auto whitespace-nowrap p-3 text-primary">

                @can('content_page_create')
                    {{-- <a class="btn btn-primary getMyFormModal" href="{{ route('admin.content-pages.create') }}"
                    data-title="{{ __('global.add_page') }}"
                    data-url="{{ route('admin.form.getMyForm') }}"
                    data-form-name="{{ encrypt('Add Page') }}"
                    data-id="{{ encrypt('0') }}">
                    
                        {{ trans('global.add') }} {{ trans('cruds.contentPage.title_singular') }}
                    </a> --}}
                    <a href="{{ route('admin.content-pages.create') }}" class="btn btn-primary">{{ trans('global.add') }} {{ trans('cruds.contentPage.title_singular') }}</a>

                @endcan

            </div>
            <div class="panel mt-6">
                @livewire('content-page.index')
            </div>
        </div>
    </div>
@endsection
