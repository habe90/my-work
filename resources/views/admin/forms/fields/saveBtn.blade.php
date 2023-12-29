@method( $formSettings['method'] )
@csrf

<input type="hidden" name="formName" value="{{ encrypt($formName) }}">
<input type="hidden" name="recordID" value="{{ encrypt($formSettings['recordID']) }}">

<div class="form-group row align-items-center">
    <label class="col-md-3 control-label text-lg-end mb-0"></label>
    <div class="col-md-8">
        <button id="submitBtn-{{ $uniquekey }}" class="btn btn-primary  {{ $formSettings['modalForm'] == 'yes' ? 'reloadMypage' : '' }}" type="submit">{{ __('global.save') }}</button>
    </div>
</div>

<script>
    $(document).ready(function(){
        $('#submitBtn-{{ $uniquekey }}').on('click', function(e) {
            e.preventDefault(); 
            var url = '{{ route($formSettings['action']) }}';

            if(url){
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
                    },
                    url: url,
                    type: 'POST',
                    data: $("#myForm-{{ $uniquekey }}").serialize(),
                    success: function(response) {
                        if(response.status == 'success'){
                            $('.is-invalid').removeClass('is-invalid');
                            $('.invalid-feedback').remove();
                            toastr.success(response.message);

                            if ($(e.target).hasClass('reloadMypage')) {
                                setTimeout(function () { location.reload(true); }, 1500);
                            } 
                        } else {
                            toastr.error(response.message);
                        }
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {        
                            $('.is-invalid').removeClass('is-invalid');
                            $('.invalid-feedback').remove();

                            var errors = xhr.responseJSON.errors;
                            for (var error in errors) {
                                var inputElement = $('[name="' + error + '"]');
                                inputElement.addClass('is-invalid');
                                inputElement.after('<div class="invalid-feedback">' + errors[error][0] + '</div>');
                            }
                        } else {
                            toastr.error('{{ __('global.something_went_wrong') }}');
                        }
                    }
                });
            } else {
                toastr.error('{{ __('global.undefined_form_url') }}');
            }
        });
    });
</script>