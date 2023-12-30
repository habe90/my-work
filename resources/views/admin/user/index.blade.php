@extends('layouts.admin')
@section('content')
    <div class="animate__animated p-6" :class="[$store.app.animation]">
        <div x-data="exportTable">
            <div class="panel flex items-center overflow-x-auto whitespace-nowrap p-3 text-primary">
                <div class="card-header-container flex items-center space-x-3">
                    @can('user_create')
                        <a class="btn bg-primary bg-indigo-600 text-white font-bold py-2 px-4 rounded-lg mb-1 getMyFormModal"
                            data-title="{{ __('global.add_user') }}"
                            data-url="{{ route('admin.form.getMyForm') }}"
                            data-form-name="{{ encrypt('Add User') }}"
                            data-id="{{ encrypt('0') }}">
                            <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="24px"
                            height="24px"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.5"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            class="h-5 w-5"
                        >
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg>
                            {{ trans('global.add') }} {{ trans('cruds.user.title_singular') }}
                        </a>
                    @endcan
                </div>
            </div>
            <div class="panel mt-6">
                @livewire('user.index')
            </div>
        </div>
    </div>
@endsection
