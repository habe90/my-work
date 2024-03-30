@extends('layouts.admin')
@section('content')
<div class="animate__animated p-6" :class="[$store.app.animation]">
    <div class="panel">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.create') }}
                    {{ trans('cruds.contentPage.title_singular') }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            @livewire('content-page.create')
        </div>
    </div>
</div>
@endsection

@push('js')
<!-- JavaScript kod za inicijalizaciju biblioteka -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // NiceSelect inicijalizacija
        var selects = document.querySelectorAll(".selectize");
        selects.forEach(function(select) {
            NiceSelect.bind(select);
        });

        // EasyMDE inicijalizacija za polje 'page_text'
        new EasyMDE({
            element: document.getElementById('mde-page_text'),
            autosave: {
                enabled: true,
                delay: 1000,
                uniqueId: 'contentPage.page_text'
            }
        });

        // EasyMDE inicijalizacija za polje 'excerpt'
        new EasyMDE({
            element: document.getElementById('mde-excerpt'),
            autosave: {
                enabled: true,
                delay: 1000,
                uniqueId: 'contentPage.excerpt'
            }
        });

        // FileUploadWithPreview inicijalizacija za 'featured_image'
        new FileUploadWithPreview('myFirstImage', {
            images: {
                baseImage: 'assets/images/file-preview.png',
                backgroundImage: '',
            },
        });
    });
</script>
@endpush
