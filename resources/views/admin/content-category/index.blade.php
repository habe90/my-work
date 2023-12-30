@extends('layouts.admin')
@section('content')
    <div class="animate__animated p-6" :class="[$store.app.animation]">
        <div x-data="exportTable">
            <div class="panel flex items-center overflow-x-auto whitespace-nowrap p-3 text-primary">

                @can('content_category_create')
                    <a class="btn btn-primary" href="{{ route('admin.content-categories.create') }}">
                        {{ trans('global.add') }} {{ trans('cruds.contentCategory.title_singular') }}
                    </a>
                @endcan

            </div>
            <div class="panel mt-6">
                @livewire('content-category.index')
            </div>
        </div>
    </div>
@endsection
