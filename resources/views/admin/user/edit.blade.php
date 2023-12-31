@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container text-center">
                <h6 class="card-title">
                    {{ trans('global.edit') }}
                    {{ trans('cruds.user.title_singular') }}:
                    {{ trans('cruds.user.fields.id') }}
                    <span class="font-bold">: {{ $user->id }}</span>
                </h6>
            </div>
        </div>

        <div class="card-body">
            @livewire('user.edit', [$user])
        </div>
    </div>
</div>
@endsection