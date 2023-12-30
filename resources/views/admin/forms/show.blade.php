@extends('layouts.admin')

@section('content')
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold leading-tight text-gray-900">{{ __('global.form') }}</h2>
            <h4 class="mt-2 text-lg text-gray-600">{{ $form->name }} #ID: {{ $form->id }}</h4>
        </div>
        <div class="flex justify-end pb-4">
            <div>
                <a class="cursor-pointer first-letter:mb-1 mt-1 me-1 modal-with-zoom-anim ws-normal btn btn-primary getMyFormModal"
                    data-title="{{ __('global.add_field') }}" data-url="{{ route('admin.form.getMyForm') }}"
                    data-form-name="{{ encrypt('Form fields') }}" data-id="{{ encrypt('0') }}">

                    {{ __('global.add_field') }}
                </a>
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
                    @include('admin.forms.attrForm', $fields)

                </div>
            </div>
        </div>
    </div>

    <!-- end: page -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.0/Sortable.min.js"></script>
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

            var el = document.getElementById('example1');
            var sortable = Sortable.create(el, {
                animation: 200,
                ghostClass: 'gu-transit',
                onEnd: function(evt) {
                    // Funkcija koja se poziva nakon što se element pomjeri
                    var data = sortable.toArray();
                    console.log(data); // Dohvati sortirani niz ID-ova
                    updateOrder(data); // Poziv funkcije za ažuriranje redoslijeda
                }
            });

            function updateOrder(data) {
            var dataString = {
                data: JSON.stringify(data),
                _token: '{{ csrf_token() }}' // CSRF token iz Laravela
            };
        
        $.ajax({
            type: "POST",
            url: "{{ route('admin.superadmin.update_order') }}",
            data: dataString,
            success: function(response) {
                if (response.status === 'success') {
                    toastr.success('{{ __("global.order_sussesfully_updated") }}');
                } else {
                    toastr.error('{{ __("global.order_error") }}');
                }
            },
            error: function(xhr, status, error) {
                toastr.error('{{ __("global.order_error") }}');
            },
        });
    }

            
        });  
          
    </script>


@endsection
