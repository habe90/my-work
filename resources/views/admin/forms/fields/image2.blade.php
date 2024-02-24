<div class="input-group">
    <input type="file" 
        class="{{ $input_object_classes }}" 
        name="{{ $formFieldData[0]->input_name }}"
        value="{{ $value }}" 
        id="thumbnail-{{ $formFieldData[0]->input_id }}"
        @if ($formFieldData[0]->is_required == 'yes') required @endif 
        @if ($formFieldData[0]->is_disabled == 'yes') disabled @endif
        @if ($formFieldData[0]->input_placeholder != null) placeholder="{{ $formFieldData[0]->input_placeholder }}" @endif
        @if ($formFieldData[0]->input_style != null) style="{{ $formFieldData[0]->input_style }}" @endif>
    <!-- Ovdje smo uklonili dio za File Manager -->
</div>
<div class="image-container" style="position: relative; display: inline-block;">
    <img id="holder-{{ $formFieldData[0]->input_id }}" src="{{ $value }}" 
        style="margin-top:15px;max-width:200px;max-height:200px;">
    @if ($value)
        <button type="button" class="btn btn-danger remove-image" 
                style="position: absolute; top: 0; right: 0;"
                data-input="thumbnail-{{ $formFieldData[0]->input_id }}">
            X
        </button>
    @endif
</div>

<script>
$(document).ready(function() {
    // Funkcionalnost za uklanjanje slike ostaje ista
    $('.remove-image').on('click', function(e) {
        e.preventDefault();
        var inputId = $(this).data('input');
        $('#' + inputId).val(''); 
        $(this).parent('.image-container').hide(); 
    });

    // Provjerava da li svaki kontejner za sliku ima postavljenu sliku, ako ne, sakrije kontejner
    $('.image-container').each(function() {
        if (!$(this).find('img').attr('src')) {
            $(this).hide();
        }
    });
});
</script>
