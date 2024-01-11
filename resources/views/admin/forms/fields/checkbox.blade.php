@foreach ($obtainedData as $key => $optionValue)
        <input 
            type="checkbox" 
            class="{{ $input_object_classes }}" 
            name="{{ $formFieldData[0]->input_name }}[]" 
            value="{{ $key }}" 
            id="{{ $formFieldData[0]->input_id }}_{{ $key }}"
            @if (is_array($value) && in_array($key, $value)) checked @endif

            @if ($formFieldData[0]->is_required == 'yes')
                required=""
            @endif

            @if ($formFieldData[0]->is_disabled == 'yes')
                disabled
            @endif
        > {{ setTranslationLabel($optionValue) }}

@endforeach
