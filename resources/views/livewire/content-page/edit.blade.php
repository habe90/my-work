<form wire:submit.prevent="submit" class="space-y-5">
    <div class="form-group {{ $errors->has('contentPage.title') ? 'invalid' : '' }}">
        <label class="form-label required" for="title">{{ trans('cruds.contentPage.fields.title') }}</label>
        <input class="form-input" type="text" name="title" id="title" required wire:model="contentPage.title">
        <div class="validation-message">
            {{ $errors->first('contentPage.title') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.contentPage.fields.title_helper') }}
        </div>
    </div>

    <div class="form-group {{ $errors->has('contentPage.slug') ? 'invalid' : '' }}">
        <label class="form-label required" for="slug">{{ trans('cruds.contentPage.fields.slug') }}</label>
        <input class="form-input" type="text" name="slug" id="slug" required wire:model="contentPage.slug">
        <div class="validation-message">
            {{ $errors->first('contentPage.slug') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.contentPage.fields.slug_helper') }}
        </div>
    </div>
    <div wire:ignore>
    <div class="form-group {{ $errors->has('category') ? 'invalid' : '' }}">
        <label class="form-label" for="category">{{ trans('cruds.contentPage.fields.category') }}</label>
        <select class="selectize form-control" id="category" name="category" wire:model="category" multiple>
            @foreach ($this->listsForFields['category'] as $value => $label)
                <option value="{{ $value }}">{{ $label }}</option>
            @endforeach
        </select>
        <div class="validation-message">
            {{ $errors->first('category') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.contentPage.fields.category_helper') }}
        </div>
    </div>
</div>
<div wire:ignore>
    <div class="form-group {{ $errors->has('tag') ? 'invalid' : '' }}">
        <label class="form-label" for="tag">{{ trans('cruds.contentPage.fields.tag') }}</label>
        <select class="selectize form-control" id="tag" name="tag" wire:model="tag" multiple>
            @foreach ($this->listsForFields['tag'] as $value => $label)
                <option value="{{ $value }}">{{ $label }}</option>
            @endforeach
        </select>
        <div class="validation-message">
            {{ $errors->first('tag') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.contentPage.fields.tag_helper') }}
        </div>
    </div>
</div>

    <div wire:ignore class="form-group {{ $errors->has('contentPage.page_text') ? 'invalid' : '' }}">
        <label class="form-label" for="page_text">{{ trans('cruds.contentPage.fields.page_text') }}</label>
        <textarea id="mde-page_text"></textarea>
        <div class="validation-message">
            {{ $errors->first('contentPage.page_text') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.contentPage.fields.page_text_helper') }}
        </div>
    </div>

    <div wire:ignore class="form-group {{ $errors->has('contentPage.excerpt') ? 'invalid' : '' }}">
        <label class="form-label" for="excerpt">{{ trans('cruds.contentPage.fields.excerpt') }}</label>
        <textarea id="mde-excerpt"></textarea>
        <div class="validation-message">
            {{ $errors->first('contentPage.excerpt') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.contentPage.fields.excerpt_helper') }}
        </div>
    </div>

    <div class="form-group {{ $errors->has('mediaCollections.content_page_featured_image') ? 'invalid' : '' }}">
        <label class="form-label" for="featured_image">{{ trans('cruds.contentPage.fields.featured_image') }}</label>
        <div class="custom-file-container" data-upload-id="myFirstImage"></div>
        <div class="validation-message">
            {{ $errors->first('mediaCollections.content_page_featured_image') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.contentPage.fields.featured_image_helper') }}
        </div>
    </div>

    <div class="form-group">
        <button class="btn btn-primary" type="submit">
            {{ trans('global.save') }}
        </button>
   
    </div>
</form>

<script>
 document.addEventListener("DOMContentLoaded", function() {
    // Inicijalizacija NiceSelect ili slične biblioteke
    var selects = document.querySelectorAll('.selectize');
    selects.forEach(function(select) {
        NiceSelect.bind(select);
    });

    // Dodavanje event listenera na select polja
    document.getElementById('category').addEventListener('change', function(e) {
        @this.set('category', Array.from(e.target.selectedOptions).map(option => option.value));
    });

    document.getElementById('tag').addEventListener('change', function(e) {
        @this.set('tag', Array.from(e.target.selectedOptions).map(option => option.value));
    });

    // Inicijalizacija i sinkronizacija EasyMDE editora
    if (typeof EasyMDE !== 'undefined') {
        // Page text editor
        var easyMDEPageText = new EasyMDE({ element: document.getElementById('mde-page_text') });
        easyMDEPageText.codemirror.on('change', function() {
            @this.set('contentPage.page_text', easyMDEPageText.value());
        });

        // Excerpt editor
        var easyMDEExcerpt = new EasyMDE({ element: document.getElementById('mde-excerpt') });
        easyMDEExcerpt.codemirror.on('change', function() {
            @this.set('contentPage.excerpt', easyMDEExcerpt.value());
        });
    } else {
        console.error('EasyMDE nije definisan.');
    }

    // Inicijalizacija FileUploadWithPreview ako je potrebno
    if (typeof FileUploadWithPreview !== 'undefined' && FileUploadWithPreview.FileUploadWithPreview) {
        // ... FileUploadWithPreview kod ...
    } else {
        console.error('FileUploadWithPreview nije definisan ili nije pravilno učitan.');
    }
});


    // Livewire hookovi za sinkronizaciju sa EasyMDE
    Livewire.hook('message.processed', (message, component) => {
        if (typeof EasyMDE !== 'undefined') {
            var easyMDEPageText = new EasyMDE({
                element: document.getElementById('mde-page_text')
            });
            easyMDEPageText.codemirror.on('change', function() {
                @this.set('contentPage.page_text', easyMDEPageText.value());
            });

            var easyMDEExcerpt = new EasyMDE({
                element: document.getElementById('mde-excerpt')
            });
            easyMDEExcerpt.codemirror.on('change', function() {
                @this.set('contentPage.excerpt', easyMDEExcerpt.value());
            });
        } else {
            console.error('EasyMDE nije definisan.');
        }
    });
</script>
