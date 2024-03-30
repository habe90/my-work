<form wire:submit.prevent="submit" class="space-y-5">
    <!-- Polje za naslov -->
    <div class="form-group {{ $errors->has('contentPage.title') ? 'invalid' : '' }}">
        <label class="form-label required" for="title">{{ trans('cruds.contentPage.fields.title') }}</label>
        <input class="form-input" type="text" name="title" id="title" required wire:model.defer="contentPage.title">
        <div class="validation-message">
            {{ $errors->first('contentPage.title') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.contentPage.fields.title_helper') }}
        </div>
    </div>

    <div class="form-group {{ $errors->has('contentPage.slug') ? 'invalid' : '' }}">
        <label class="form-label required" for="title">{{ trans('cruds.contentPage.fields.slug') }}</label>
        <input class="form-input" type="text" name="slug" id="slug" required wire:model.defer="contentPage.slug">
        <div class="validation-message">
            {{ $errors->first('contentPage.slug') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.contentPage.fields.slug_helper') }}
        </div>
    </div>

    <!-- Polje za kategoriju bez Livewire-a i s NiceSelect -->
    <div class="form-group {{ $errors->has('category') ? 'invalid' : '' }}">
        <label class="form-label" for="category">{{ trans('cruds.contentPage.fields.category') }}</label>
        <select class="selectize form-control" id="category" name="category" multiple>
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

    <!-- Polje za tagove bez Livewire-a i s NiceSelect -->
    <div class="form-group {{ $errors->has('tag') ? 'invalid' : '' }}">
        <label class="form-label" for="tag">{{ trans('cruds.contentPage.fields.tag') }}</label>
        <select class="selectize form-control" id="tag" name="tag" multiple>
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

    <!-- Polje za tekst stranice s EasyMDE -->
    <div class="form-group {{ $errors->has('contentPage.page_text') ? 'invalid' : '' }}">
        <label class="form-label" for="page_text">{{ trans('cruds.contentPage.fields.page_text') }}</label>
        <textarea id="mde-page_text" wire:model.defer="contentPage.page_text"></textarea>
        <div class="validation-message">
            {{ $errors->first('contentPage.page_text') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.contentPage.fields.page_text_helper') }}
        </div>
    </div>

    <!-- Polje za izvod s EasyMDE -->
    <div class="form-group {{ $errors->has('contentPage.excerpt') ? 'invalid' : '' }}">
        <label class="form-label" for="excerpt">{{ trans('cruds.contentPage.fields.excerpt') }}</label>
        <textarea id="mde-excerpt" wire:model.defer="contentPage.excerpt"></textarea>
        <div class="validation-message">
            {{ $errors->first('contentPage.excerpt') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.contentPage.fields.excerpt_helper') }}
        </div>
    </div>

    <!-- Polje za otpremanje slike s FileUploadWithPreview -->
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

    <!-- Dugmad za akcije -->
    <div class="form-group">
        <button class="btn btn-primary !mt-6" type="submit">
            {{ trans('global.save') }}
        </button>
        
        {{-- <a href="{{ route('admin.content-pages.index') }}" class="btn btn-secondary !mt-6">
            {{ trans('global.cancel') }}
        </a> --}}
    </div>
</form>

<script>
    document.addEventListener("DOMContentLoaded", function(e) {
        // NiceSelect inicijalizacija
        var selects = document.querySelectorAll(".selectize");
        selects.forEach(function(select) {
            NiceSelect.bind(select);
        });

        // Provjera da li EasyMDE klasa postoji prije inicijalizacije
        if (typeof EasyMDE !== 'undefined') {
            // EasyMDE inicijalizacija za 'page_text'
            var easyMDEPageText = new EasyMDE({
                element: document.getElementById('mde-page_text'),
                autosave: {
                    enabled: true,
                    delay: 1000,
                    uniqueId: 'contentPage.page_text'
                }
            });

            // EasyMDE inicijalizacija za 'excerpt'
            var easyMDEExcerpt = new EasyMDE({
                element: document.getElementById('mde-excerpt'),
                autosave: {
                    enabled: true,
                    delay: 1000,
                    uniqueId: 'contentPage.excerpt'
                }
            });
        } else {
            console.error('EasyMDE nije definisan.');
        }

        // Pravilna inicijalizacija FileUploadWithPreview za 'featured_image'
        if (typeof FileUploadWithPreview !== 'undefined' && FileUploadWithPreview.FileUploadWithPreview) {
            new FileUploadWithPreview.FileUploadWithPreview('myFirstImage', {
                images: {
                    baseImage: 'assets/images/file-preview.svg',
                    backgroundImage: '',
                },
            });
        } else {
            console.error('FileUploadWithPreview nije definisan ili nije pravilno učitan.');
        }
    });
</script>
