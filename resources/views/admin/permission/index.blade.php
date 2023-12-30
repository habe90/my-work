@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-white">
        <div class="card-header border-b border-blueGray-200 flex items-center justify-center">
            <div class="card-header-container flex items-center space-x-3">
                {{-- Naslov --}}
                <h6 class="card-title">
                    {{ trans('cruds.permission.title_singular') }}
                    {{ trans('global.list') }}
                     <span class="ml-1">:</span>
                </h6>

                {{-- Dugme za dodavanje --}}
                @can('permission_create')
                    <a class="btn bg-primary bg-indigo-600 text-white font-bold py-2 px-4 rounded-lg mb-1" href="{{ route('admin.permissions.create') }}">
                        {{ trans('global.add') }} {{ trans('cruds.permission.title_singular') }}
                    </a>
                @endcan
            </div>
        </div>
        @livewire('permission.index')
    </div>
</div>

@endsection