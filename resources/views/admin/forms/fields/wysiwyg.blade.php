
    <!-- Ovo je textarea koju će TinyMCE pretvoriti u WYSIWYG editor -->
    <textarea id="editor" style="background-color: #eeeeef; padding: 50px 0;" class="form-input" name="page_text">{!! $value !!}</textarea>



    <script>
       $(document).ready(function() {
    tinymce.init({
        selector: 'textarea#editor', // Ovaj selektor cilja vaš textarea element
        plugins: 'code table lists',
        toolbar: 'undo redo | formatselect | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table',
        setup: function (editor) {
            editor.on('change', function () {
                editor.save(); // Ovo će ažurirati textarea sa trenutnim sadržajem TinyMCE-a
            });
        }
    });

    $('form.my-dynamic-form').on('submit', function(e) {
        // e.preventDefault(); // Odkomentarišite ako želite testirati bez slanja forme
        tinymce.triggerSave(); // Forsira TinyMCE da ažurira textarea prije slanja forme
        var htmlContent = $('textarea#editor').val();
        console.log(htmlContent); // Ispisuje sadržaj u konzolu za provjeru
        // Dalje možete poslati formu ili raditi šta je potrebno sa sadržajem
    });
});

      </script>