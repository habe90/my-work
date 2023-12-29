@extends('layouts.admin')
@section('content')
<div class="animate__animated p-6" :class="[$store.app.animation]">
    <div x-data="mailbox">
        <div class="relative flex h-full gap-5 sm:h-[calc(100vh_-_150px)]">
          <div class="overlay absolute z-[5] hidden h-full w-full rounded-md bg-black/60" :class="{'!block xl:!hidden' : isShowMailMenu}" @click="isShowMailMenu = !isShowMailMenu"></div>

          <div class="panel dark:gray-50 absolute z-10 hidden h-full w-[250px] max-w-full flex-none space-y-3 overflow-hidden p-4 ltr:rounded-r-none rtl:rounded-l-none xl:relative xl:block xl:h-auto ltr:xl:rounded-r-md rtl:xl:rounded-l-md" :class="{'!block' : isShowMailMenu}">
            @include('admin.message.nav-messages')
        </div>

        <div class="panel h-full flex-1 overflow-auto p-0">
            <div  class="flex h-full flex-col">
                
                <div class="card-header border-b border-blueGray-200">
                    <div class="card-header-container">
                        <h6 class="card-title">
                            {{ $title }}
                        </h6>
                    </div>
                </div>

                <div class="overdlow-hidden">
                    <div class="overdlow-x-auto">
                        <table class="table table-messages w-full">
                            <thead>
                                <tr>
                                    <th>{{ __('global.subject') }}</th>
                                    <th>{{ __('global.recipients') }}</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($conversations as $conversation)
                                    <tr class="cursor-pointer" x-data="{ 'isUnread': @json($conversation->is_unread) }">
                                        <td class="p-0">
                                            <a href="{{ route('admin.messages.show', $conversation) }}" class="block px-4 py-2" :class="{ 'font-bold': isUnread }">
                                                {{ $conversation->subject }}
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.messages.show', $conversation) }}" class="block px-4 py-2 text-xs" :class="{ 'font-bold': isUnread }">
                                                @foreach($conversation->recipients->reject(function($user) {
                                                    return $user->id === auth()->id();
                                                    }) as $user)
                                                    {{ $user->name }}
                                                    &lt;{{ $user->email }}&gt;{{ !$loop->last ? ', ' : '' }}
                                                @endforeach
                                            </a>
                                        </td>
                                        <td class="px-4 py-2">
                                            <div class="flex justify-end">
                                                <form action="{{ route('admin.messages.destroy', $conversation) }}" method="POST">
                                                    @csrf
                                                    <button class="btn btn-sm btn-rose mr-2" type="submit">
                                                        {{ __('global.delete') }}
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td class="px-4 py-2">{{ __('global.you_have_no_messages') }}</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card-body"></div>
            </div>
        </div>
    </div>
    </div>
</div>
@endsection