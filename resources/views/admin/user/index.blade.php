@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-white">
        <div class="card-header border-b border-blueGray-200 flex items-center justify-center">
            <div class="card-header-container flex items-center space-x-3">
                {{-- Naslov --}}
                <h6 class="card-title">
                    {{ trans('cruds.user.title_singular') }}
                    {{ trans('global.list') }}
                    <span class="ml-1">:</span>
                </h6>

                @can('user_create')
                    <a class="btn bg-primary bg-indigo-600 text-white font-bold py-2 px-4 rounded-lg mb-1" href="{{ route('admin.users.create') }}">
                        {{ trans('global.add') }} {{ trans('cruds.user.title_singular') }}
                    </a>
                @endcan
            </div>
        </div>
        @livewire('user.index')

    </div>
</div>
@endsection