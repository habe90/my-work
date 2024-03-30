<form wire:submit.prevent="submit" class="space-y-5">
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
    <!-- Category field with NiceSelect -->
    <div class="form-group {{ $errors->has('category') ? 'invalid' : '' }}">
        <label class="form-label" for="category">{{ trans('cruds.contentPage.fields.category') }}</label>
        <select class="selectize form-control" id="category" name="category" wire:model="category" multiple>
            @foreach($this->listsForFields['category'] as $value => $label)
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
    <!-- Tag field with NiceSelect -->
    <div class="form-group {{ $errors->has('tag') ? 'invalid' : '' }}">
        <label class="form-label" for="tag">{{ trans('cruds.contentPage.fields.tag') }}</label>
        <select class="selectize form-control" id="tag" name="tag" wire:model="tag" multiple>
            @foreach($this->listsForFields['tag'] as $value => $label)
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
    <!-- ... other fields ... -->
    <!-- Featured Image field with FileUploadWithPreview -->
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
    <!-- ... other fields ... -->
    <div class="form-group">
        <button class="btn btn-indigo mr-2" type="submit">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.content-pages.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>
    </div>
</form>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var selects = document.querySelectorAll(".selectize");
        selects.forEach(function(select) {
            NiceSelect.bind(select);
        });

        new FileUploadWithPreview.FileUploadWithPreview('myFirstImage', {
            images: {
                baseImage: 'assets/images/file-preview.png',
                backgroundImage: '',
            },
        });
    });
</script>
