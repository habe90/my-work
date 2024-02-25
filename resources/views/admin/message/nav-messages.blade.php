<div class="panel dark:gray-50 absolute z-10 hidden h-full w-[250px] max-w-full flex-none space-y-3 overflow-hidden p-4 ltr:rounded-r-none rtl:rounded-l-none xl:relative xl:block xl:h-auto ltr:xl:rounded-r-md rtl:xl:rounded-l-md">
<div class="flex h-full flex-col pb-16">
    <div class="pb-5">
        <a href="{{ route('admin.messages.create') }}" class="btn btn-primary w-full" @click="openMail('add')">
            <i class="fas fa-fw fa-pen-alt"></i>
            New Message
        </a>
    </div>

    <div class="perfect-scrollbar relative -mr-3.5 h-full grow pr-3.5 ps">
        <div class="space-y-1">
            <a href="{{ route('admin.messages.index') }}" class="{{ request()->is('admin/messages') ? 'sidebar-nav-active' : 'sidebar-nav' }} flex h-10 w-full items-center justify-between rounded-md p-2 font-medium hover:bg-white-dark/10 hover:text-primary dark:hover:bg-[#181F32] dark:hover:text-primary bg-gray-100 dark:text-primary text-primary dark:bg-[#181F32]" :class="{ 'bg-gray-100 dark:text-primary text-primary dark:bg-[#181F32]': !isEdit &amp;&amp; selectedTab === 'inbox' }" @click="tabChanged('inbox')">
                <div class="flex items-center">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0">
                        <path d="M9.15316 5.40838C10.4198 3.13613 11.0531 2 12 2C12.9469 2 13.5802 3.13612 14.8468 5.40837L15.1745 5.99623C15.5345 6.64193 15.7144 6.96479 15.9951 7.17781C16.2757 7.39083 16.6251 7.4699 17.3241 7.62805L17.9605 7.77203C20.4201 8.32856 21.65 8.60682 21.9426 9.54773C22.2352 10.4886 21.3968 11.4691 19.7199 13.4299L19.2861 13.9372C18.8096 14.4944 18.5713 14.773 18.4641 15.1177C18.357 15.4624 18.393 15.8341 18.465 16.5776L18.5306 17.2544C18.7841 19.8706 18.9109 21.1787 18.1449 21.7602C17.3788 22.3417 16.2273 21.8115 13.9243 20.7512L13.3285 20.4768C12.6741 20.1755 12.3469 20.0248 12 20.0248C11.6531 20.0248 11.3259 20.1755 10.6715 20.4768L10.0757 20.7512C7.77268 21.8115 6.62118 22.3417 5.85515 21.7602C5.08912 21.1787 5.21588 19.8706 5.4694 17.2544L5.53498 16.5776C5.60703 15.8341 5.64305 15.4624 5.53586 15.1177C5.42868 14.773 5.19043 14.4944 4.71392 13.9372L4.2801 13.4299C2.60325 11.4691 1.76482 10.4886 2.05742 9.54773C2.35002 8.60682 3.57986 8.32856 6.03954 7.77203L6.67589 7.62805C7.37485 7.4699 7.72433 7.39083 8.00494 7.17781C8.28555 6.96479 8.46553 6.64194 8.82547 5.99623L9.15316 5.40838Z" stroke="currentColor" stroke-width="1.5"></path>
                    </svg>
                    <div class="ltr:ml-3 rtl:mr-3">{{ __('global.all_messages') }}</div>
                </div>
                <div class="whitespace-nowrap rounded-md bg-primary-light py-0.5 px-2 font-semibold dark:bg-[#060818]" x-text="mailList &amp;&amp; mailList.filter((d) => d.type == 'inbox').length">
                    @if ($unreadConversations['all'])
                    <span class="text-xs bg-rose-500 text-white px-2 py-1 rounded-xl font-bold float-right">
                        {{ $unreadConversations['all'] }}
                    </span>
                @endif
                </div>
            </a>
            <a href="{{ route('admin.messages.inbox') }}" class="{{ request()->is('admin/messages/inbox') ? 'sidebar-nav-active' : 'sidebar-nav' }} flex h-10 w-full items-center justify-between rounded-md p-2 font-medium hover:bg-white-dark/10 hover:text-primary dark:hover:bg-[#181F32] dark:hover:text-primary bg-gray-100 dark:text-primary text-primary dark:bg-[#181F32]" :class="{ 'bg-gray-100 dark:text-primary text-primary dark:bg-[#181F32]': !isEdit &amp;&amp; selectedTab === 'inbox' }" @click="tabChanged('inbox')">
                <div class="flex items-center">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5  shrink-0">
                        <path opacity="0.5" d="M2 12C2 8.22876 2 6.34315 3.17157 5.17157C4.34315 4 6.22876 4 10 4H14C17.7712 4 19.6569 4 20.8284 5.17157C22 6.34315 22 8.22876 22 12C22 15.7712 22 17.6569 20.8284 18.8284C19.6569 20 17.7712 20 14 20H10C6.22876 20 4.34315 20 3.17157 18.8284C2 17.6569 2 15.7712 2 12Z" stroke="currentColor" stroke-width="1.5"></path>
                        <path d="M6 8L8.1589 9.79908C9.99553 11.3296 10.9139 12.0949 12 12.0949C13.0861 12.0949 14.0045 11.3296 15.8411 9.79908L18 8" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                    </svg>
                    <div class="ltr:ml-3 rtl:mr-3"> {{ __('global.inbox') }}</div>
                </div>
                <div class="whitespace-nowrap rounded-md bg-primary-light py-0.5 px-2 font-semibold dark:bg-[#060818]" x-text="mailList &amp;&amp; mailList.filter((d) => d.type == 'inbox').length">
                    @if ($unreadConversations['inbox'])
                    <span class="text-xs bg-rose-500 text-white px-2 py-1 rounded-xl font-bold float-right">
                        {{ $unreadConversations['inbox'] }}
                    </span>
                @endif
                </div>
            </a>
            <a href="{{ route('admin.messages.outbox') }}" class="flex h-10 w-full items-center justify-between rounded-md p-2 font-medium hover:bg-white-dark/10 hover:text-primary dark:hover:bg-[#181F32] dark:hover:text-primary bg-gray-100 dark:text-primary text-primary dark:bg-[#181F32]" :class="{ 'bg-gray-100 dark:text-primary text-primary dark:bg-[#181F32]': !isEdit &amp;&amp; selectedTab === 'sent_mail' }" @click="tabChanged('sent_mail')">
                <div class="flex items-center">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0">
                        <path d="M17.4975 18.4851L20.6281 9.09373C21.8764 5.34874 22.5006 3.47624 21.5122 2.48782C20.5237 1.49939 18.6511 2.12356 14.906 3.37189L5.57477 6.48218C3.49295 7.1761 2.45203 7.52305 2.13608 8.28637C2.06182 8.46577 2.01692 8.65596 2.00311 8.84963C1.94433 9.67365 2.72018 10.4495 4.27188 12.0011L4.55451 12.2837C4.80921 12.5384 4.93655 12.6658 5.03282 12.8075C5.22269 13.0871 5.33046 13.4143 5.34393 13.7519C5.35076 13.9232 5.32403 14.1013 5.27057 14.4574C5.07488 15.7612 4.97703 16.4131 5.0923 16.9147C5.32205 17.9146 6.09599 18.6995 7.09257 18.9433C7.59255 19.0656 8.24576 18.977 9.5522 18.7997L9.62363 18.79C9.99191 18.74 10.1761 18.715 10.3529 18.7257C10.6738 18.745 10.9838 18.8496 11.251 19.0285C11.3981 19.1271 11.5295 19.2585 11.7923 19.5213L12.0436 19.7725C13.5539 21.2828 14.309 22.0379 15.1101 21.9985C15.3309 21.9877 15.5479 21.9365 15.7503 21.8474C16.4844 21.5244 16.8221 20.5113 17.4975 18.4851Z" stroke="currentColor" stroke-width="1.5"></path>
                        <path opacity="0.5" d="M6 18L21 3" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                    </svg>
                    <div class="ltr:ml-3 rtl:mr-3"> {{ __('global.outbox') }}</div>
                    @if ($unreadConversations['outbox'])
                        <span class="text-xs bg-rose-500 text-white px-2 py-1 rounded-xl font-bold float-right">
                            {{ $unreadConversations['outbox'] }}
                        </span>
                    @endif
                </div>
            </a>
        </div>
    </div>
</div>
</div>