@foreach ($obtainedData as $key => $optionValue)
    <label class="radio-inline">
        <input 
            type="radio" 
            name="{{ $formFieldData[0]->input_name }}" 
            value="{{ $key }}" 
            @if ($key == trim($value, " '\"")) checked @endif

            @if ( $formFieldData[0]->is_required == 'yes' )
                required=""
            @endif

            @if ( $formFieldData[0]->is_disabled == 'yes' )
                disabled
            @endif
        > {{ setTranslationLabel($optionValue) }}
    </label>
@endforeach
