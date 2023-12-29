@if (isset($field))

@foreach ($field->fieldsData as $data)
    <form action="{{ route('admin.superadmin.updateFormFieldsData') }}" method="POST">
        @method('POST')
        @csrf

        <input name="id" type="hidden" value="{{ encrypt($data->id) }}">
        <input name="form_fields_id" type="hidden" value="{{ myCryptie($data->form_fields_id) }}">
        <div class="mt-3 mb-3">
            <label for="input_id" class="block text-left">{{ __('global.id') }}</label>
            <input type="text" class="form-input {{ $errors->has('input_id') ? 'border-red-500' : '' }}" name="input_id" id="input_id" value="{{ $data->input_id }}" required>
            @if ($errors->has('input_id'))
                <span class="text-red-500">{{ $errors->first('input_id') }}</span>
            @endif
        </div>
        <div class="mt-3 mb-3">
            <label for="input_name" class="block text-left">{{ __('global.name') }}</label>
            <input type="text" class="form-input {{ $errors->has('input_name') ? 'border-red-500' : '' }}" name="input_name" id="input_name" value="{{ $data->input_name }}" required>
            @if ($errors->has('input_name'))
                <span class="text-red-500">{{ $errors->first('input_name') }}</span>
            @endif
        </div>
        <div class="mt-3 mb-3">
            <label for="is_required" class="block text-left">{{ __('global.required') }}</label>
            <select class="form-select {{ $errors->has('is_required') ? 'border-red-500' : '' }}" name="is_required" id="is_required" required>
                <option value="yes" {{ ($data->is_required === 'yes') ? 'selected' : '' }}>{{ __('global.yes') }}</option>
                <option value="no" {{ ($data->is_required === 'no' || $data->is_required === null) ? 'selected' : '' }}>{{ __('global.no') }}</option>
            </select>
            @if ($errors->has('is_required'))
                <span class="text-red-500">{{ $errors->first('is_required') }}</span>
            @endif
        </div>
        <div class="mt-3 mb-3">
            <label for="input_encoded" class="block text-left">{{ __('global.save_envoded') }}</label>
            <select class="form-select {{ $errors->has('input_encoded') ? 'border-red-500' : '' }}" name="input_encoded" id="input_encoded" required>
                <option value="yes" {{ ($data->input_encoded === 'yes') ? 'selected' : '' }}>{{ __('global.yes') }}</option>
                <option value="yes_myCryptie" {{ ($data->input_encoded === 'yes_myCryptie') ? 'selected' : '' }}>{{ __('global.yes') }} {{ __('global.myCryptie_encryption') }}</option>
                <option value="no" {{ ($data->input_encoded === 'no' || $data->input_encoded === null) ? 'selected' : '' }}>{{ __('global.no') }}</option>
            </select>
            @if ($errors->has('input_encoded'))
                <span class="text-red-500">{{ $errors->first('input_encoded') }}</span>
            @endif
        </div>
        <div class="mt-3 mb-3">
            <label for="input_validation" class="block text-left">{{ __('global.validation') }}</label>
            <input type="text" class="form-input {{ $errors->has('input_validation') ? 'border-red-500' : '' }}" name="input_validation" id="input_validation" value="{{ $data->input_validation }}">
            @if ($errors->has('input_validation'))
                <span class="text-red-500">{{ $errors->first('input_validation') }}</span>
            @endif
        </div>
        <div class="mt-3 mb-3">
            <label for="default_value" class="block text-left">{{ __('global.default_value') }}</label>
            <input type="text" class="form-input {{ $errors->has('default_value') ? 'border-red-500' : '' }}" name="default_value" id="default_value" value="{{ $data->default_value }}">
            @if ($errors->has('default_value'))
                <span class="text-red-500">{{ $errors->first('default_value') }}</span>
            @endif
        </div>
        <div class="mt-3 mb-3">
            <label for="input_placeholder" class="block text-left">{{ __('global.placeholder') }}</label>
            <input type="text" class="form-input {{ $errors->has('input_placeholder') ? 'border-red-500' : '' }}" name="input_placeholder" id="input_placeholder" value="{{ $data->input_placeholder }}">
            @if ($errors->has('input_placeholder'))
                <span class="text-red-500">{{ $errors->first('input_placeholder') }}</span>
            @endif
        </div>
        <div class="mt-3 mb-3">
            <label for="is_disabled" class="block text-left">{{ __('global.disabled') }}</label>
            <select class="form-select {{ $errors->has('is_disabled') ? 'border-red-500' : '' }}" name="is_disabled" id="is_disabled">
                <option value="yes" {{ ($data->is_disabled === 'yes') ? 'selected' : '' }}>{{ __('global.yes') }}</option>
                <option value="no" {{ ($data->is_disabled === 'no' || $data->is_disabled === null) ? 'selected' : '' }}>{{ __('global.no') }}</option>
            </select>
            @if ($errors->has('is_disabled'))
                <span class="text-red-500">{{ $errors->first('is_disabled') }}</span>
            @endif
        </div>
        <div class="mt-3 mb-3">
            <label for="input_style" class="block text-left">{{ __('global.style') }}</label>
            <input type="text" class="form-input {{ $errors->has('input_style') ? 'border-red-500' : '' }}" name="input_style" id="input_style" value="{{ $data->input_style }}">
            @if ($errors->has('input_style'))
                <span class="text-red-500">{{ $errors->first('input_style') }}</span>
            @endif
        </div>
        <div class="mt-3 mb-3">
            <label for="info_text" class="block text-left">{{ __('global.info_text') }}</label>
            <input type="text" class="form-input {{ $errors->has('info_text') ? 'border-red-500' : '' }}" name="info_text" id="info_text" value="{{ $data->info_text }}">
            @if ($errors->has('info_text'))
                <span class="text-red-500">{{ $errors->first('info_text') }}</span>
            @endif
        </div>
        @php
            $classes = json_decode($data->classes);
        @endphp
        <div class="mt-3 mb-3">
            <label for="groupe_div_classes" class="block text-left">{{ __('global.classes') }}</label>
            <div class="grid grid-cols-4 gap-4">
                <div class="col-span-1">
                    <input type="text" class="form-input" name="groupe_div_classes" id="groupe_div_classes" value="{{ $classes->groupe_div_classes ?? '' }}">
                </div>
                <div class="col-span-1">
                    <input type="text" class="form-input" name="label_classes" id="label_classes" value="{{ $classes->label_classes ?? '' }}">
                </div>
                <div class="col-span-1">
                    <input type="text" class="form-input" name="input_div_classes" id="input_div_classes" value="{{ $classes->input_div_classes ?? '' }}">
                </div>
                <div class="col-span-1">
                    <input type="text" class="form-input" name="input_object_classes" id="input_object_classes" value="{{ $classes->input_object_classes ?? '' }}">
                </div>
            </div>
        </div>

        @if (in_array($field->type, ['select', 'radio', 'checkbox', 'select2']))
            @php
                $get_info_from = json_decode($data->get_info_from);
                $get_info_from_check = ((!isset($get_info_from->get_info_from)) ? null : $get_info_from->get_info_from);
            @endphp
            <div class="mt-3 mb-3">
                <label for="get_info_from" class="block text-left">{{ __('global.get_info_from') }}</label>
                <select class="form-select {{ $errors->has('is_disabled') ? 'border-red-500' : '' }}" name="get_info_from" id="get_info_from">
                    <option value="" {{ ($get_info_from_check === null) ? 'selected' : '' }}>{{ __('global.select') }}</option>
                    <option value="db" {{ ($get_info_from_check === 'db') ? 'selected' : '' }}>{{ __('global.database') }}</option>
                    <option value="array" {{ ($get_info_from_check === 'array') ? 'selected' : '' }}>{{ __('global.array') }}</option>
                </select>
            </div>
            <div class="mt-3 mb-3 db-settings">
                <label class="block text-left">{{ __('global.database_settings') }}</label>
                <div class="grid grid-cols-2 gap-4">
                    <div class="col-span-1">
                        <label for="db_table">{{ __('global.db_table') }}</label>
                        <input type="text" class="form-input" name="db_table" value="{{ $get_info_from->db_table ?? '' }}">
                    </div>
                    <div class="col-span-1">
                        <label for="db_where_statement">{{ __('global.db_where_statement') }}</label>
                        <input type="text" class="form-input" name="db_where_statement" value="{{ $get_info_from->db_where_statement ?? '' }}">
                    </div>
                </div>
            </div>
            <div class="mt-3 mb-3 db-settings">
                <div class="grid grid-cols-2 gap-4">
                    <div class="col-span-1">
                        <label for="db_value_field">{{ __('global.db_value_field') }}</label>
                        <input type="text" class="form-input" name="db_value_field" value="{{ $get_info_from->db_value_field ?? '' }}">
                    </div>
                    <div class="col-span-1">
                        <label for="db_label_field">{{ __('global.db_label_field') }}</label>
                        <input type="text" class="form-input" name="db_label_field" value="{{ $get_info_from->db_label_field ?? '' }}">
                    </div>
                </div>
            </div>

            <div class="mt-3 mb-3 array-settings">
                <label for="array" class="block text-left">{{ __('global.array') }}</label>
                <input type="text" class="form-input {{ $errors->has('get_info_from_array') ? 'border-red-500' : '' }}" name="array" id="array" value="{{ $get_info_from->array ?? '' }}">
            </div>

            <script>
                $(document).ready(function()
               {

                    if( '{{ $get_info_from_check }}' == 'db'){
                        $('.db-settings').show();
                        $('.array-settings').hide();
                    } else if ( '{{ $get_info_from_check }}' == 'array' ){
                        $('.db-settings').hide();
                        $('.array-settings').show();
                    } else {
                        $('.db-settings').hide();
                        $('.array-settings').hide();
                    }

                    $('#get_info_from').on('change', function() {
                        if ($(this).val() == 'db') {
                           $('.db-settings').show();
                           $('.array-settings').hide();
                        } else if ($(this).val() == 'array') {
                           $('.db-settings').hide();
                           $('.array-settings').show();
                        } else {
                           $('.db-settings').hide();
                           $('.array-settings').hide();
                        }
                    });
               });
           </script>
            
        @endif

        <div class="mt-3 mb-3">
            <button class="btn btn-primary" type="submit">{{ __('global.save') }}</button>
        </div>
    </form>
    <!-- Ostala polja -->
@endforeach
@endif
