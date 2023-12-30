<div class="summernote" data-plugin-summernote data-plugin-options='{ "height": 180 }'>
    <div style="background-color: #eeeeef; padding: 50px 0; ">
        {!! $value !!}
    </div>
</div>
<script>
    $(document).ready(function() {
        $('.summernote').summernote({
            height: 180,
        });
    });
</script>
    