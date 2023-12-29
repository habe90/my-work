@extends('layouts.admin')

@section('content')
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold leading-tight text-gray-900">{{ __('global.form') }}</h2>
            <h4 class="mt-2 text-lg text-gray-600">{{ $form->name }} #ID: {{ $form->id }}</h4>
        </div>
        <div class="flex justify-end pb-4">
            <div x-data="{ open: false }">
                <button type="button" class="btn btn-secondary" @click="open = true">Open Modal</button>
            </div>
        </div>
    </header>
    <!-- start: page -->

    <div class="flex flex-wrap -mx-4">
        <div class="w-full lg:w-1/3 px-6 mb-4 lg:mb-0 pt-6">
            <div class="bg-white shadow rounded-lg p-6">
                <h2 class="text-xl font-semibold text-gray-800">{{ __('global.form_fields') }}</h2>
                <div class="grid grid-cols-1 gap-x-12 sm:grid-cols-1">
                    <div class="dd" id="nestable">
                        <ul class="dd-list" id="example1">
                            @if (count($form->formFields) > 0)
                                @foreach ($form->formFields as $field)
                                    <li class="mb-2.5 cursor-grab" data-id="{{ encrypt($field->id) }}">

                                        <div
                                            class="items-md-center flex flex-col rounded-md border border-white-light bg-white px-6 py-3.5 text-center dark:border-dark dark:bg-[#1b2e4b] md:flex-row ltr:md:text-left rtl:md:text-right">
                                            <div class="ltr:sm:mr-4 rtl:sm:ml-4">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18"
                                                    stroke="currentColor" class="mx-auto h-11 w-11 text-gray-500">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M3 4h12m-12 4h12m-12 4h12m-12 4h12" />
                                                </svg>
                                            </div>
                                            <div class="flex flex-1 flex-col items-center justify-between md:flex-row">
                                                <div class="my-3 font-semibold md:my-0">
                                                    <a class="settings-link getSettingsLink text-blue-500 hover:text-blue-700"
                                                        data-field-id="{{ myCryptie($field->id) }}">{{ $field->label ?? '' }}</a>
                                                    <div class="text-xs text-white-dark">
                                                        {{ $field->type ?? '' }}
                                                    </div>
                                                </div>

                                                <div class="flex">
                                                    <button type="button" class="btn btn-secondary btn-sm px-5 py-2"
                                                        style="margin-right: 16px;">View</button>


                                                    <form action="{{ route('admin.form.fields.destroy') }}" method="POST"
                                                        class="inline">
                                                        @csrf <!-- Laravel CSRF token -->
                                                        @method('DELETE')
                                                        <input type="hidden" name="id"
                                                            value="{{ encrypt($field->id) }}"> <!-- Id polja -->
                                                        <button class="btn btn-danger btn-sm px-5 py-2" type="submit"
                                                            data-title="{{ sprintf(__('global.confirm_remove_form_field'), strtolower($field->label)) }}">
                                                            Delete <!-- Tekst dugmeta -->
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            @else
                                <li class="text-center">
                                    {{ __('global.form_has_no_fields') }}
                                </li>
                            @endif
                        </ul>
                    </div>
                    <input type="hidden" id="nestable-output">
                </div>
            </div>
        </div>
        <div class="w-full lg:w-2/3 px-6 pt-6">
            <div class="bg-white shadow rounded-lg mb-6 p-6">
                <h4 class="text-xl font-semibold text-gray-800">{{ __('global.field_settings') }}:</h4>
                <div id="settingsBody">
                    <!-- Ovdje će se učitati postavke polja -->
                    <p class="mt-3 text-gray-600">{{ __('global.load_field_settings') }}</p>
                    @php
                        if (!isset($fields)) {
                            $fields = [];
                        }
                    @endphp
                    @include('admin.forms.attrform', $fields)

                </div>
            </div>
        </div>
    </div>

    <!-- end: page -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="application/javascript">
        $(document).ready(function()
        {
            // get field settings of selectend field
            $(document).on('click', '.getSettingsLink', function() {
                var fieldId = $(this).data('field-id');
                
                // Fetch field settings using AJAX and update the form
                $.ajax({
                    url: @json(route('admin.superadmin.getAttr', '')) + "/" + (fieldId ? fieldId : ''),
                    type: 'GET',
                    success: function(data) {
                        $('#settingsBody').html(data);
                    }
                });
            });

            @if (\Session::has('fieldId'))
                // get the correct form field data after saving the form
                var fieldId = '{!! \Session::get('fieldId') !!}';
             
                // Fetch field settings using AJAX and update the form
                $.ajax({
                    url: @json(route('admin.superadmin.getAttr', '')) + "/" + (fieldId ? fieldId : ''),
                    type: 'GET',
                    success: function(data) {
                        $('#settingsBody').html(data);
                    }
                });
            @endif

            @if (\Session::has('success'))
                toastr.success('{!! \Session::get('success') !!}');
            @endif
            
            @if (\Session::has('error'))
                toastr.error('{!! \Session::get('error') !!}');
            @endif
        });    
    </script>
  <script>
    $(document).on('click', '.getMyFormModal', function(e) {
    e.preventDefault(); 

    var url = $(this).data('url');
    var modalTitle = $(this).data('title');
    var dataString = {
        recordID: $(this).data('id'), 
        formName: $(this).data('form-name'), 
        modalForm: 'yes'
    };

    if(url){
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: url,
            type: 'POST',
            data: dataString,
            success: function(response) {
                // Postavite sadržaj modala
                $('#modalBody').html(response);
                // Otvorite modal koristeći Alpine.js
                document.querySelector('[x-data]').__x.$data.open = true;
            },
            error: function(xhr) {
                toastr.error('Forma nije pronađena.');
            }
        });
    } else {
        toastr.error('URL forme nije definisan.');
    }
});

  </script>
    
@endsection
