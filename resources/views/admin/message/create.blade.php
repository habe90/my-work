@extends('layouts.admin')
@section('content')



        <div class="relative">
            <div class="flex items-center py-4 px-6">
                <button
                    type="button"
                    class="block hover:text-primary ltr:mr-3 rtl:ml-3 xl:hidden"
                    @click="isShowMailMenu = !isShowMailMenu"
                >
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6">
                        <path d="M20 7L4 7" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                        <path opacity="0.5" d="M20 12L4 12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                        <path d="M20 17L4 17" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                    </svg>
                </button>
                <h4 class="text-lg font-medium text-gray-600 dark:text-gray-400">Message</h4>
            </div>
            <div class="h-px bg-gradient-to-l from-indigo-900/20 via-black to-indigo-900/20 opacity-[0.1] dark:via-white"></div>    
                    <form action="{{ route('admin.messages.store') }}" method="POST" class="grid gap-6 p-6">
                        @csrf
                        <div class="form-group {{ $errors->has('to') ? 'invalid' : '' }}">
                            <div class="flex flex-col lg:flex-row lg:items-center">
                               
                                <select name="to[]" id="to" class="form-input"   required >
                                    <option></option>
                                    <option value="null" disabled>{{ __('global.pleaseSelect') }}</option>
                                    @foreach($users as $id => $email)
                                        <option value="{{ $id }}">{{ $email }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="validation-message">
                                {{ $errors->first('to') }}
                            </div>
                        </div>
                        <div class="{{ $errors->has('subject') ? 'invalid' : '' }}">
                            <div class="flex flex-col lg:flex-row lg:items-center ">
                               
                                <input class="form-input" type="text" name="subject" id="subject" required placeholder="{{ __('global.subject') }}">
                            </div>
                            <div class="validation-message">
                                {{ $errors->first('subject') }}
                            </div>
                        </div>
                        <div class="{{ $errors->has('body') ? 'invalid' : '' }}">
                            <textarea class="form-input" name="body" id="body" required rows="8" placeholder="{{ __('global.body') }}"></textarea>
                            <div class="validation-message">
                                {{ $errors->first('body') }}
                            </div>
                        </div>
                        
                        <div class="mt-8 flex items-center ltr:ml-auto rtl:mr-auto">
                            <a href="{{ route('admin.messages.index') }}" class="btn btn-outline-danger ltr:mr-3 rtl:ml-3" @click="closeMsgPopUp">    {{ trans('global.discard') }}</a>
                            <button type="sumbit" class="btn btn-primary" @click="saveMail('send',params.id)">{{ trans('global.send') }}</button>
                        </div>

                    </form>
        </div>

@endsection

@push('scripts')
    <script>
        $(function(){
    $('#to').select2({
        placeholder: '{{ __('global.pleaseSelect') }}',
        allowClear: false
    })
});
    </script>
@endpush