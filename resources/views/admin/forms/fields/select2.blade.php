<select multiple data-plugin-selectTwo
    name="{{ $formFieldData[0]->input_name }}" 
    class="{{ $input_object_classes }} populate" 
    id="{{ $formFieldData[0]->input_id }}"

    @if ( $formFieldData[0]->is_required == 'yes' )
        required=""
    @endif

    @if ( $formFieldData[0]->is_disabled == 'yes' )
        disabled
    @endif

    @if ( $formFieldData[0]->input_style  != null )
        style="{{ $formFieldData[0]->input_style  }}"
    @endif
>
    @if ( $formFieldData[0]->input_placeholder != null )
        <option>{{ $formFieldData[0]->input_placeholder }}</option>
    @endif
    
    @foreach ($obtainedData as $key => $optionValue)
        @php
            $selected = (($key == trim($value, " '\"")) ? 'selected' : '');
        @endphp
        <option value="{{ $key }}" {{ $selected }}>{{ setTranslationLabel($optionValue) }}</option>
    @endforeach    
</select>
<script>
    $(document).ready(function() {
    $('.select2').select2({
    });
});
</script>