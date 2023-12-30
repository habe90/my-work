<input 
    type="date" 
    name="{{ $formFieldData[0]->input_name }}" 
    value="{{ $value }}" 
    class="{{ $input_object_classes }} datepicker"
    id="{{ $formFieldData[0]->input_id }}"

    @if ($formFieldData[0]->is_required == 'yes')
        required
    @endif

    @if ($formFieldData[0]->is_disabled == 'yes')
        disabled
    @endif

    @if ($formFieldData[0]->input_style != null)
        style="{{ $formFieldData[0]->input_style }}"
    @endif
>
