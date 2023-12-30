@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header border-b border-blueGray-200 flex items-center justify-center">
            <div class="card-header-container flex items-center space-x-3">
                {{-- Naslov --}}
                <h6 class="card-title font-semibold text-lg my-3">
                    {{ trans('global.create') }}
                    {{ trans('cruds.user.title_singular') }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            @livewire('user.create')
        </div>
    </div>
</div>
@endsection