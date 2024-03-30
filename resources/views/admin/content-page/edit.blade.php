@extends('layouts.admin')
@section('content')
       <div class="animate__animated p-6" :class="[$store.app.animation]">
        <div x-data="exportTable">
            <div class="panel">
           
                <div class="mb-5 flex items-center justify-between">
                    <h5 class="text-lg font-semibold dark:text-white-light">  {{ trans('global.edit') }} /page/{{ $contentPage->id }}</h5>
                    <a class="font-semibold hover:text-gray-400 dark:text-gray-400 dark:hover:text-gray-600" href="javascript:;" @click="toggleCode('code13')">
                        <a href="{{ route('admin.content-pages.index') }}" class="btn btn-secondary">
                            {{ trans('global.cancel') }}
                        </a>
                    </a>
                </div>
            
                <div class="card-body">
                    @livewire('content-page.edit', [$contentPage])
                </div>
            </div>
        </div>
    </div>
    
    <script>
        var quill = new Quill('#editor', {
            theme: 'snow',
        });
        var toolbar = quill.container.previousSibling;
        toolbar.querySelector('.ql-picker').setAttribute('title', 'Font Size');
        toolbar.querySelector('button.ql-bold').setAttribute('title', 'Bold');
        toolbar.querySelector('button.ql-italic').setAttribute('title', 'Italic');
        toolbar.querySelector('button.ql-link').setAttribute('title', 'Link');
        toolbar.querySelector('button.ql-underline').setAttribute('title', 'Underline');
        toolbar.querySelector('button.ql-clean').setAttribute('title', 'Clear Formatting');
        toolbar.querySelector('[value=ordered]').setAttribute('title', 'Ordered List');
        toolbar.querySelector('[value=bullet]').setAttribute('title', 'Bullet List');
    </script>
@endsection
