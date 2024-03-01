@extends('layouts.admin')
@section('content')
<div class="flex flex-wrap items-center justify-between p-4">
    <div class="flex items-center">
        <button type="button" class="hover:text-primary ltr:mr-2 rtl:ml-2" @click="selectedMail = null">
            <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                class="h-5 w-5 rtl:rotate-180"
            >
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
            </svg>
        </button>

        <h4 class="text-base font-medium ltr:mr-2 rtl:ml-2 md:text-lg" > {{ $conversation->subject }}</h4>
        <div class="badge bg-info hover:top-0">Inbox</div>
    </div>
    <button x-tooltip="Print" data-placement="top" role="tooltip" type="button">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5">
            <path
                d="M6 17.9827C4.44655 17.9359 3.51998 17.7626 2.87868 17.1213C2 16.2426 2 14.8284 2 12C2 9.17157 2 7.75736 2.87868 6.87868C3.75736 6 5.17157 6 8 6H16C18.8284 6 20.2426 6 21.1213 6.87868C22 7.75736 22 9.17157 22 12C22 14.8284 22 16.2426 21.1213 17.1213C20.48 17.7626 19.5535 17.9359 18 17.9827"
                stroke="currentColor"
                stroke-width="1.5"
            />
            <path opacity="0.5" d="M9 10H6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
            <path d="M19 14L5 14" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
            <path
                d="M18 14V16C18 18.8284 18 20.2426 17.1213 21.1213C16.2426 22 14.8284 22 12 22C9.17157 22 7.75736 22 6.87868 21.1213C6 20.2426 6 18.8284 6 16V14"
                stroke="currentColor"
                stroke-width="1.5"
                stroke-linecap="round"
            />
            <path
                opacity="0.5"
                d="M17.9827 6C17.9359 4.44655 17.7626 3.51998 17.1213 2.87868C16.2427 2 14.8284 2 12 2C9.17158 2 7.75737 2 6.87869 2.87868C6.23739 3.51998 6.06414 4.44655 6.01733 6"
                stroke="currentColor"
                stroke-width="1.5"
            />
            <circle opacity="0.5" cx="17" cy="10" r="1" fill="currentColor" />
            <path opacity="0.5" d="M15 16.5H9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
            <path opacity="0.5" d="M13 19H9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
        </svg>
    </button>
</div>
<div class="h-px border-b border-[#e0e6ed] dark:border-[#1b2e4b]"></div>
<div class="relative p-4">
    <div class="flex flex-wrap">
        <div class="flex-shrink-0 ltr:mr-2 rtl:ml-2">
            <img
                x-show="selectedMail.path"
                :src="`assets/images/${selectedMail.path}`"
                class="h-12 w-12 rounded-full object-cover"
                alt="avatar"
            />
            <div x-show="!selectedMail.path" class="rounded-full border border-gray-300 p-3 dark:border-gray-800">
                <svg
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-5 w-5"
                >
                    <circle cx="12" cy="6" r="4" stroke="currentColor" stroke-width="1.5" />
                    <ellipse opacity="0.5" cx="12" cy="17" rx="7" ry="4" stroke="currentColor" stroke-width="1.5" />
                </svg>
            </div>
        </div>
        <div class="flex-1 ltr:mr-2 rtl:ml-2">
            <div class="flex items-center">
                <div
                    class="whitespace-nowrap text-lg ltr:mr-4 rtl:ml-4"
                >
                {{ __('global.from') }}:
                                    {{ $conversation->owner->name }}
                                    &lt;{{ $conversation->owner->email }}&gt;
            </div>
                <div
                    x-show="selectedMail.group"
                    x-dynamictooltip="selectedMail.group"
                    role="tooltip"
                    class="ltr:mr-4 rtl:ml-4"
                >
                    <div
                        class="h-2 w-2 rounded-full"
                        :class="{
            'bg-primary': selectedMail.group === 'personal',
            'bg-warning': selectedMail.group === 'work',
            'bg-success': selectedMail.group === 'social',
            'bg-danger': selectedMail.group === 'private',
        }"
                    ></div>
                </div>
                <div class="whitespace-nowrap text-white-dark">1 days ago</div>
            </div>
            <div class="flex items-center text-white-dark">
                <div
                    class="ltr:mr-1 rtl:ml-1"
                    x-text="selectedMail.type === 'sent_mail' ? selectedMail.email : 'to me'"
                ></div>
                <div x-data="dropdown" @click.outside="open = false" class="dropdown">
                    <button type="button" class="mt-1.5" @click="toggle">
                        <svg
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5"
                        >
                            <path
                                d="M19 9L12 15L5 9"
                                stroke="currentColor"
                                stroke-width="1.5"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            />
                        </svg>
                    </button>
                    <ul
                        x-cloak
                        x-show="open"
                        x-transition
                        x-transition.duration.300ms
                        class="ltr:left-0 rtl:right-0 sm:w-56"
                    >
                        <li>
                            <div class="flex items-center px-4 py-2">
                                <div class="w-1/4 text-white-dark ltr:mr-2 rtl:ml-2">From:</div>
                                <div
                                    class="flex-1"
                                    x-text="selectedMail.type === 'sent_mail' ? 'tailly@gmail.com' : selectedMail.email"
                                ></div>
                            </div>
                        </li>
                        <li>
                            <div class="flex items-center px-4 py-2">
                                <div class="w-1/4 text-white-dark ltr:mr-2 rtl:ml-2">To:</div>
                                <div
                                    class="flex-1"
                                    x-text="selectedMail.type !== 'sent_mail' ? 'tailly@gmail.com' : selectedMail.email"
                                ></div>
                            </div>
                        </li>
                        <li>
                            <div class="flex items-center px-4 py-2">
                                <div class="w-1/4 text-white-dark ltr:mr-2 rtl:ml-2">Date:</div>
                                <div class="flex-1" x-text="selectedMail.date + ', ' + selectedMail.time"></div>
                            </div>
                        </li>
                        <li>
                            <div class="flex items-center px-4 py-2">
                                <div class="w-1/4 text-white-dark ltr:mr-2 rtl:ml-2">Subject:</div>
                                <div class="flex-1" x-text="selectedMail.title"></div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div>
            <div class="flex items-center justify-center space-x-3 rtl:space-x-reverse">
                <button
                    x-tooltip="Star"
                    data-placement="top"
                    role="tooltip"
                    type="button"
                    class="enabled:hover:text-warning disabled:opacity-60"
                    :class="{ 'text-warning': selectedMail.isStar }"
                    @click="setStar(selectedMail.id)"
                    :disabled="selectedTab === 'trash'"
                >
                    <svg
                        width="24"
                        height="24"
                        viewBox="0 0 24 24"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5"
                        :class="{ 'fill-warning': selectedMail.isStar }"
                    >
                        <path
                            d="M9.15316 5.40838C10.4198 3.13613 11.0531 2 12 2C12.9469 2 13.5802 3.13612 14.8468 5.40837L15.1745 5.99623C15.5345 6.64193 15.7144 6.96479 15.9951 7.17781C16.2757 7.39083 16.6251 7.4699 17.3241 7.62805L17.9605 7.77203C20.4201 8.32856 21.65 8.60682 21.9426 9.54773C22.2352 10.4886 21.3968 11.4691 19.7199 13.4299L19.2861 13.9372C18.8096 14.4944 18.5713 14.773 18.4641 15.1177C18.357 15.4624 18.393 15.8341 18.465 16.5776L18.5306 17.2544C18.7841 19.8706 18.9109 21.1787 18.1449 21.7602C17.3788 22.3417 16.2273 21.8115 13.9243 20.7512L13.3285 20.4768C12.6741 20.1755 12.3469 20.0248 12 20.0248C11.6531 20.0248 11.3259 20.1755 10.6715 20.4768L10.0757 20.7512C7.77268 21.8115 6.62118 22.3417 5.85515 21.7602C5.08912 21.1787 5.21588 19.8706 5.4694 17.2544L5.53498 16.5776C5.60703 15.8341 5.64305 15.4624 5.53586 15.1177C5.42868 14.773 5.19043 14.4944 4.71392 13.9372L4.2801 13.4299C2.60325 11.4691 1.76482 10.4886 2.05742 9.54773C2.35002 8.60682 3.57986 8.32856 6.03954 7.77203L6.67589 7.62805C7.37485 7.4699 7.72433 7.39083 8.00494 7.17781C8.28555 6.96479 8.46553 6.64194 8.82547 5.99623L9.15316 5.40838Z"
                            stroke="currentColor"
                            stroke-width="1.5"
                        />
                    </svg>
                </button>

                <button
                    x-tooltip="Important"
                    data-placement="top"
                    role="tooltip"
                    type="button"
                    class="rotate-90 enabled:hover:text-primary disabled:opacity-60"
                    :class="{ 'text-primary': selectedMail.isImportant }"
                    @click="setImportant(selectedMail.id)"
                    :disabled="selectedTab === 'trash'"
                >
                    <svg
                        width="24"
                        height="24"
                        viewBox="0 0 24 24"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-4.5 w-4.5 rotate-90"
                        :class="{ 'fill-primary': selectedMail.isImportant }"
                    >
                        <path
                            d="M21 16.0909V11.0975C21 6.80891 21 4.6646 19.682 3.3323C18.364 2 16.2426 2 12 2C7.75736 2 5.63604 2 4.31802 3.3323C3 4.6646 3 6.80891 3 11.0975V16.0909C3 19.1875 3 20.7358 3.73411 21.4123C4.08421 21.735 4.52615 21.9377 4.99692 21.9915C5.98402 22.1045 7.13673 21.0849 9.44216 19.0458C10.4612 18.1445 10.9708 17.6938 11.5603 17.5751C11.8506 17.5166 12.1494 17.5166 12.4397 17.5751C13.0292 17.6938 13.5388 18.1445 14.5578 19.0458C16.8633 21.0849 18.016 22.1045 19.0031 21.9915C19.4739 21.9377 19.9158 21.735 20.2659 21.4123C21 20.7358 21 19.1875 21 16.0909Z"
                            stroke="currentColor"
                            stroke-width="1.5"
                        ></path>
                    </svg>
                </button>

                <button
                    x-tooltip="Reply"
                    data-placement="top"
                    role="tooltip"
                    type="button"
                    class="hover:text-info"
                    @click="openMail('reply', selectedMail)"
                >
                    <svg
                        width="24"
                        height="24"
                        viewBox="0 0 24 24"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5 rtl:hidden"
                    >
                        <path
                            d="M9.5 7L4.5 12L9.5 17"
                            stroke="currentColor"
                            stroke-width="1.5"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        />
                        <path
                            opacity="0.5"
                            d="M4.5 12L14.5 12C16.1667 12 19.5 13 19.5 17"
                            stroke="currentColor"
                            stroke-width="1.5"
                            stroke-linecap="round"
                        />
                    </svg>
                    <svg
                        width="24"
                        height="24"
                        viewBox="0 0 24 24"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5 ltr:hidden rtl:block"
                    >
                        <path
                            d="M14.5 7L19.5 12L14.5 17"
                            stroke="currentColor"
                            stroke-width="1.5"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        />
                        <path
                            opacity="0.5"
                            d="M19.5 12L9.5 12C7.83333 12 4.5 13 4.5 17"
                            stroke="currentColor"
                            stroke-width="1.5"
                            stroke-linecap="round"
                        />
                    </svg>
                </button>

                <button
                    x-tooltip="Forward"
                    data-placement="top"
                    role="tooltip"
                    type="button"
                    class="hover:text-info"
                    @click="openMail('forward', selectedMail)"
                >
                    <svg
                        width="24"
                        height="24"
                        viewBox="0 0 24 24"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5 ltr:hidden rtl:block"
                    >
                        <path
                            d="M9.5 7L4.5 12L9.5 17"
                            stroke="currentColor"
                            stroke-width="1.5"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        />
                        <path
                            opacity="0.5"
                            d="M4.5 12L14.5 12C16.1667 12 19.5 13 19.5 17"
                            stroke="currentColor"
                            stroke-width="1.5"
                            stroke-linecap="round"
                        />
                    </svg>
                    <svg
                        width="24"
                        height="24"
                        viewBox="0 0 24 24"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5 rtl:hidden"
                    >
                        <path
                            d="M14.5 7L19.5 12L14.5 17"
                            stroke="currentColor"
                            stroke-width="1.5"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        />
                        <path
                            opacity="0.5"
                            d="M19.5 12L9.5 12C7.83333 12 4.5 13 4.5 17"
                            stroke="currentColor"
                            stroke-width="1.5"
                            stroke-linecap="round"
                        />
                    </svg>
                </button>
            </div>
        </div>
    </div>
    <div
        class="prose mt-8 max-w-full prose-p:text-sm prose-img:m-0 prose-img:inline-block dark:prose-p:text-white md:prose-p:text-sm">
    <div class="chat-conversation-box min-h-[400px] space-y-5 p-4 pb-[68px] sm:min-h-[300px] sm:pb-0">    
        @foreach($conversation->messages as $message)
            <div class="flex items-start gap-3" :class="{'justify-end' : {{ (int) $message->user_id === (int) auth()->id() }}}">
                <div class="flex-none" :class="{'order-2' : {{ (int) $message->user_id === (int) auth()->id() }}}">
                    <!-- Slika korisnika -->
                    <img src="{{ $message->user->image ?? 'putanja_do_default_slike' }}" class="h-10 w-10 rounded-full object-cover">

                </div>
                <div class="space-y-2">
                    <div class="flex items-center gap-3">
                        <!-- Tekst poruke -->
                        <div class="{{ (int) $message->user_id === (int) auth()->id() ? 'bg-primary text-white' : 'bg-black/10 dark:bg-gray-800' }} rounded-md p-4 py-2 ltr:rounded-bl-none rtl:rounded-br-none">
                            {{ $message->body }}
                        </div>
                    </div>
                    <!-- Vrijeme poruke -->
                    <div class="text-xs text-white-dark" :class="{'ltr:text-right rtl:text-left' : {{ (int) $message->user_id === (int) auth()->id() }}}">
                        {{ $message->created_at->diffForHumans() }}
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    
</div>
 

    <div class="mt-8" x-show="selectedMail.attachments">
        <div class="absolute bottom-0 left-0 w-full p-4">
            <div class="w-full items-center space-x-3 rtl:space-x-reverse sm:flex">
                <div class="relative flex-1">
                    <input id="" class="form-input rounded-full border-0 bg-[#f4f4f4] px-12 py-2 focus:outline-none" placeholder="Type a message" x-model="textMessage" @keyup.enter="sendMessage()">
                    <button type="button" class="absolute top-1/2 -translate-y-1/2 hover:text-primary ltr:left-4 rtl:right-4">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5">
                            <circle opacity="0.5" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="1.5"></circle>
                            <path d="M9 16C9.85038 16.6303 10.8846 17 12 17C13.1154 17 14.1496 16.6303 15 16" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                            <path d="M16 10.5C16 11.3284 15.5523 12 15 12C14.4477 12 14 11.3284 14 10.5C14 9.67157 14.4477 9 15 9C15.5523 9 16 9.67157 16 10.5Z" fill="currentColor"></path>
                            <ellipse cx="9" cy="10.5" rx="1" ry="1.5" fill="currentColor"></ellipse>
                        </svg>
                    </button>
                    <button type="button" class="absolute top-1/2 -translate-y-1/2 hover:text-primary ltr:right-4 rtl:left-4" @click="sendMessage()">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5">
                            <path d="M17.4975 18.4851L20.6281 9.09373C21.8764 5.34874 22.5006 3.47624 21.5122 2.48782C20.5237 1.49939 18.6511 2.12356 14.906 3.37189L5.57477 6.48218C3.49295 7.1761 2.45203 7.52305 2.13608 8.28637C2.06182 8.46577 2.01692 8.65596 2.00311 8.84963C1.94433 9.67365 2.72018 10.4495 4.27188 12.0011L4.55451 12.2837C4.80921 12.5384 4.93655 12.6658 5.03282 12.8075C5.22269 13.0871 5.33046 13.4143 5.34393 13.7519C5.35076 13.9232 5.32403 14.1013 5.27057 14.4574C5.07488 15.7612 4.97703 16.4131 5.0923 16.9147C5.32205 17.9146 6.09599 18.6995 7.09257 18.9433C7.59255 19.0656 8.24576 18.977 9.5522 18.7997L9.62363 18.79C9.99191 18.74 10.1761 18.715 10.3529 18.7257C10.6738 18.745 10.9838 18.8496 11.251 19.0285C11.3981 19.1271 11.5295 19.2585 11.7923 19.5213L12.0436 19.7725C13.5539 21.2828 14.309 22.0379 15.1101 21.9985C15.3309 21.9877 15.5479 21.9365 15.7503 21.8474C16.4844 21.5244 16.8221 20.5113 17.4975 18.4851Z" stroke="currentColor" stroke-width="1.5"></path>
                            <path opacity="0.5" d="M6 18L21 3" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                        </svg>
                    </button>
                </div>
                <div class="hidden items-center space-x-3 py-3 rtl:space-x-reverse sm:block sm:py-0">
                    <button type="button" class="rounded-md bg-[#f4f4f4] p-2 hover:bg-primary-light hover:text-primary dark:bg-[#1b2e4b]">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5">
                            <path d="M7 8C7 5.23858 9.23858 3 12 3C14.7614 3 17 5.23858 17 8V11C17 13.7614 14.7614 16 12 16C9.23858 16 7 13.7614 7 11V8Z" stroke="currentColor" stroke-width="1.5"></path>
                            <path opacity="0.5" d="M13.5 8L17 8" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                            <path opacity="0.5" d="M13.5 11L17 11" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                            <path opacity="0.5" d="M7 8L9 8" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                            <path opacity="0.5" d="M7 11L9 11" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                            <path opacity="0.5" d="M20 10V11C20 15.4183 16.4183 19 12 19M4 10V11C4 15.4183 7.58172 19 12 19M12 19V22" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                            <path d="M22 2L2 22" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                        </svg>
                    </button>
                    <button type="button" class="rounded-md bg-[#f4f4f4] p-2 hover:bg-primary-light hover:text-primary dark:bg-[#1b2e4b]">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5">
                            <path opacity="0.5" d="M17 9.00195C19.175 9.01406 20.3529 9.11051 21.1213 9.8789C22 10.7576 22 12.1718 22 15.0002V16.0002C22 18.8286 22 20.2429 21.1213 21.1215C20.2426 22.0002 18.8284 22.0002 16 22.0002H8C5.17157 22.0002 3.75736 22.0002 2.87868 21.1215C2 20.2429 2 18.8286 2 16.0002L2 15.0002C2 12.1718 2 10.7576 2.87868 9.87889C3.64706 9.11051 4.82497 9.01406 7 9.00195" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                            <path d="M12 2L12 15M12 15L9 11.5M12 15L15 11.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </button>
                    <button type="button" class="rounded-md bg-[#f4f4f4] p-2 hover:bg-primary-light hover:text-primary dark:bg-[#1b2e4b]">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5">
                            <circle cx="12" cy="13" r="3" stroke="currentColor" stroke-width="1.5"></circle>
                            <path opacity="0.5" d="M9.77778 21H14.2222C17.3433 21 18.9038 21 20.0248 20.2646C20.51 19.9462 20.9267 19.5371 21.251 19.0607C22 17.9601 22 16.4279 22 13.3636C22 10.2994 22 8.76721 21.251 7.6666C20.9267 7.19014 20.51 6.78104 20.0248 6.46268C19.3044 5.99013 18.4027 5.82123 17.022 5.76086C16.3631 5.76086 15.7959 5.27068 15.6667 4.63636C15.4728 3.68489 14.6219 3 13.6337 3H10.3663C9.37805 3 8.52715 3.68489 8.33333 4.63636C8.20412 5.27068 7.63685 5.76086 6.978 5.76086C5.59733 5.82123 4.69555 5.99013 3.97524 6.46268C3.48995 6.78104 3.07328 7.19014 2.74902 7.6666C2 8.76721 2 10.2994 2 13.3636C2 16.4279 2 17.9601 2.74902 19.0607C3.07328 19.5371 3.48995 19.9462 3.97524 20.2646C5.09624 21 6.65675 21 9.77778 21Z" stroke="currentColor" stroke-width="1.5"></path>
                            <path d="M19 10H18" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                        </svg>
                    </button>
                    <button type="button" class="rounded-md bg-[#f4f4f4] p-2 hover:bg-primary-light hover:text-primary dark:bg-[#1b2e4b]">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 opacity-70">
                            <circle cx="5" cy="12" r="2" stroke="currentColor" stroke-width="1.5"></circle>
                            <circle opacity="0.5" cx="12" cy="12" r="2" stroke="currentColor" stroke-width="1.5"></circle>
                            <circle cx="19" cy="12" r="2" stroke="currentColor" stroke-width="1.5"></circle>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection