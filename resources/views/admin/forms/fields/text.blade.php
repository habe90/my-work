<input 
    type="text" 
    class="{{ $input_object_classes }}" 
    name="{{ $formFieldData[0]->input_name }}" 
    id="{{ $formFieldData[0]->input_id }}"
    value="{{ $value }}" 

    @if ( $formFieldData[0]->is_required == 'yes' )
        required=""
    @endif

    @if ( $formFieldData[0]->is_disabled == 'yes' )
        disabled
    @endif

    @if ( $formFieldData[0]->input_placeholder != null )
        placeholder="{{ $formFieldData[0]->input_placeholder }}"
    @endif

    @if ( $formFieldData[0]->input_style  != null )
        style="{{ $formFieldData[0]->input_style  }}"
    @endif
>