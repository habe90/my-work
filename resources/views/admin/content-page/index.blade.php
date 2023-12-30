@extends('layouts.admin')
@section('content')
    <div class="animate__animated p-6" :class="[$store.app.animation]">
        <div x-data="exportTable">
            <div class="panel flex items-center overflow-x-auto whitespace-nowrap p-3 text-primary">

                @can('content_page_create')
                    <a class="btn btn-indigo" href="{{ route('admin.content-pages.create') }}">
                        {{ trans('global.add') }} {{ trans('cruds.contentPage.title_singular') }}
                    </a>
                @endcan

            </div>
            <div class="panel mt-6">
                @livewire('content-page.index')
            </div>
        </div>
    </div>
@endsection
