@extends('layouts.admin')
@section('content')
    <div class="animate__animated p-6" :class="[$store.app.animation]">
        <div x-data="exportTable">
                <div class="panel flex items-center overflow-x-auto whitespace-nowrap p-3 text-primary">
                    @can('role_create')
                        <a class="btn bg-primary text-white" href="{{ route('admin.roles.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.role.title_singular') }}
                        </a>
                    @endcan
                </div>
                <div class="panel mt-6">
                @livewire('role.index')
            </div>

        </div>
    </div>
@endsection
