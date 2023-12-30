@extends('layouts.admin')
@section('content')
<div class="animate__animated p-6" :class="[$store.app.animation]">
    <div x-data="exportTable">
        <div class="panel flex items-center overflow-x-auto whitespace-nowrap p-3 text-primary">
            <div class="card-header-container flex items-center space-x-3">
                {{-- Add dugme header --}}
                @can('permission_create')
                    <a class="btn bg-primary bg-indigo-600 text-white font-bold py-2 px-4 rounded-lg mb-1" href="{{ route('admin.permissions.create') }}">
                        {{ trans('global.add') }} {{ trans('cruds.permission.title_singular') }}
                    </a>
                @endcan
            </div>
        </div>
        <div class="panel mt-6">
        @livewire('permission.index')
        </div>
    </div>
</div>

@endsection