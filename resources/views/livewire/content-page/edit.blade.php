<form wire:submit.prevent="submit" class="pt-3">

    <div class="form-group {{ $errors->has('contentPage.title') ? 'invalid' : '' }}">
        <label class="form-label required" for="title">{{ trans('cruds.contentPage.fields.title') }}</label>
        <input class="form-input ltr:rounded-l-none rtl:rounded-r-none" type="text" name="title" id="title"
            required wire:model.defer="contentPage.title">
        <div class="validation-message">
            {{ $errors->first('contentPage.title') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.contentPage.fields.title_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('category') ? 'invalid' : '' }}">
        <label class="form-label" for="category">{{ trans('cruds.contentPage.fields.category') }}</label>
        <x-select-list class="selectize" id="category" name="category" wire:model="category" :options="$this->listsForFields['category']"
            multiple />
        <div class="validation-message">
            {{ $errors->first('category') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.contentPage.fields.category_helper') }}
        </div>
        <div class="mb-5">
            <select class="selectize" multiple="multiple" style="display: none;">
                <option value="orange">Orange</option>
                <option value="White">White</option>
                <option value="Purple">Purple</option>
            </select>
            <div class="nice-select selectize has-multiple open" tabindex="0">
                <span class="multiple-options">Select an option</span>
                <div class="nice-select-dropdown">

                    <ul class="list">
                        <li data-value="orange" class="option null">Orange</li>
                        <li data-value="White" class="option null">White</li>
                        <li data-value="Purple" class="option null">Purple</li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
    <div class="form-group {{ $errors->has('tag') ? 'invalid' : '' }}">
        <label class="form-label" for="tag">{{ trans('cruds.contentPage.fields.tag') }}</label>
        <x-select-list class="form-control" id="tag" name="tag" wire:model="tag" :options="$this->listsForFields['tag']" multiple />
        <div class="validation-message">
            {{ $errors->first('tag') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.contentPage.fields.tag_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('contentPage.page_text') ? 'invalid' : '' }}">
        <label class="form-label" for="page_text">{{ trans('cruds.contentPage.fields.page_text') }}</label>
        <textarea id="editor" class="form-textarea" name="page_text" id="page_text" wire:model.defer="contentPage.page_text"
            rows="4"></textarea>
        <div class="validation-message">
            {{ $errors->first('contentPage.page_text') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.contentPage.fields.page_text_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('contentPage.excerpt') ? 'invalid' : '' }}">
        <label class="form-label" for="excerpt">{{ trans('cruds.contentPage.fields.excerpt') }}</label>
        <textarea class="form-textarea" name="excerpt" id="excerpt" wire:model.defer="contentPage.excerpt" rows="4"></textarea>
        <div class="validation-message">
            {{ $errors->first('contentPage.excerpt') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.contentPage.fields.excerpt_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('mediaCollections.content_page_featured_image') ? 'invalid' : '' }}">
        <label class="form-label" for="featured_image">{{ trans('cruds.contentPage.fields.featured_image') }}</label>
        <x-dropzone id="featured_image" name="featured_image" action="{{ route('admin.content-pages.storeMedia') }}"
            collection-name="content_page_featured_image" max-file-size="2" max-width="4096" max-height="4096"
            max-files="1" />
        <div class="validation-message">
            {{ $errors->first('mediaCollections.content_page_featured_image') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.contentPage.fields.featured_image_helper') }}
        </div>
    </div>


    <button class="btn btn-primary !mt-6" type="submit">
        {{ trans('global.save') }}
    </button>
    <a href="{{ route('admin.content-pages.index') }}" class="btn btn-primary !mt-6">
        {{ trans('global.cancel') }}
    </a>

</form>
