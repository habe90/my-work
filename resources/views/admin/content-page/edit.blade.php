@extends('layouts.admin')
@section('content')
    <div class="animate__animated p-6" :class="[$store.app.animation]">

        <div class="panel">

            <div class="mb-5 flex items-center justify-between">
                <h5 class="text-lg font-semibold dark:text-white-light"> {{ trans('global.edit') }}
                    /page/{{ $contentPage->id }}</h5>
                <a class="font-semibold hover:text-gray-400 dark:text-gray-400 dark:hover:text-gray-600" href="javascript:;"
                    @click="toggleCode('code13')">
                    <a href="{{ route('admin.content-pages.index') }}" class="btn btn-secondary">
                        {{ trans('global.cancel') }}
                    </a>
                </a>
            </div>

            <div class="card-body">
                @livewire('content-page.edit', [$contentPage])
            </div>
        </div>

    </div>
@endsection
