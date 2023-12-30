<div class="input-group">
    <input type="hidden" 
        class="{{ $input_object_classes }}" 
        name="{{ $formFieldData[0]->input_name }}"
        value="{{ $value }}" 
        id="thumbnail-{{ $formFieldData[0]->input_id }}"
        @if ($formFieldData[0]->is_required == 'yes') required="" @endif 
        @if ($formFieldData[0]->is_disabled == 'yes') disabled @endif
        @if ($formFieldData[0]->input_placeholder != null) placeholder="{{ $formFieldData[0]->input_placeholder }}" @endif
        @if ($formFieldData[0]->input_style != null) style="{{ $formFieldData[0]->input_style }}" @endif>
    <span class="input-group-btn">
        <button type="button" class="lfm-button btn btn-primary" 
        data-input="thumbnail-{{ $formFieldData[0]->input_id }}"
        data-preview="holder-{{ $formFieldData[0]->input_id }}">Choose image</button>   
    </span>
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
    var route_prefix = "/filemanager";
    $('.lfm-button').on('click', function(e) {
        e.preventDefault();
        var inputId = $(this).data('input');
        var holderId = $(this).data('preview');

        console.log("File manager is opening...");
        window.open(route_prefix + "?type=image", "FileManager", "width=900,height=600");

        window.SetUrl = function (items) {
            var item = items[0]; 
            if (item && item.url) {
                $('#' + inputId).val(item.url);
                $('#' + holderId).attr("src", item.url).parent('.image-container').show();
            }
        };
    });

    $('.remove-image').on('click', function(e) {
        e.preventDefault();
        var inputId = $(this).data('input');
        $('#' + inputId).val(''); 
        $(this).parent('.image-container').hide(); 
    });

  
    $('.image-container').each(function() {
        if (!$(this).find('img').attr('src')) {
            $(this).hide();
        }
    });
});

</script>
