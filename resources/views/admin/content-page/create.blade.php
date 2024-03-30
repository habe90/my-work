@extends('layouts.admin')
@section('content')
<div class="animate__animated p-6" :class="[$store.app.animation]">
    <div class="panel">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.create') }}
                    {{ trans('cruds.contentPage.title_singular') }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            @livewire('content-page.create')
        </div>
    </div>
</div>
@endsection