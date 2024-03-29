<div class="input-group">
    <input type="file" 
        class="{{ $input_object_classes }}" 
        name="{{ $formFieldData[0]->input_name }}"
        id="thumbnail-{{ $formFieldData[0]->input_id }}"
        @if ($formFieldData[0]->is_required == 'yes') required @endif 
        @if ($formFieldData[0]->is_disabled == 'yes') disabled @endif
        @if ($formFieldData[0]->input_placeholder != null) placeholder="{{ $formFieldData[0]->input_placeholder }}" @endif
        @if ($formFieldData[0]->input_style != null) style="{{ $formFieldData[0]->input_style }}" @endif>
</div>
