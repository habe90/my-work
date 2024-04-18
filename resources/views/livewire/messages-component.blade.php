<div class="col-lg-12 col-md-12 col-sm-12">
    <div class="messages-container margin-top-0">
        <div class="messages-headline">
            <h4>{{ __('front.message_history') }}</h4>
            @if (!$conversations->isEmpty() && $selectedConversationId)
                <a href="#" class="message-action"
                    wire:click.prevent="deleteConversation({{ $selectedConversationId }})"><i class="ti-trash"></i>
                    {{ __('front.delete_conversation') }}</a>
            @endif

        </div>
        <div class="messages-container-inner">

            <div class="dash-msg-inbox" style="
            background: #e3e1de80;">
               @if ($conversations->isEmpty())
               <p class="text-center mt-4">{{ __('front.no_current_conversations') }}</p>
           @else
               @foreach ($conversations as $conversation)
                   <ul>
                       <li @if ($selectedConversationId == $conversation->id) class="active-message" @endif>
                           <a href="#" wire:click="selectConversation({{ $conversation->id }})">
                               <div class="dash-msg-avatar">
                                   <img src="https://via.placeholder.com/500x500" alt="">
                                   <span class="_user_status {{ $this->isUserOnline(optional($conversation->bids->first())->user->id) ? 'online' : 'offline' }}"></span>
                               </div>
           
                               <div class="message-by">
                                   <div class="message-by-headline">
                                       @php
                                           $bid = $conversation->bids->first();
                                           $isClient = $bid->job->user_id == auth()->id();
                                           $otherParty = $isClient ? $bid->user : $bid->job->user;
                                       @endphp
                                       
                                       @if ($otherParty)
                                           <h5>{{ $isClient ? $otherParty->company_name ?? $otherParty->name : $otherParty->name }}</h5>
                                           <span>{{ $bid->created_at->diffForHumans() }}</span>
                                       @else
                                           <h5>{{ __('front.user_not_available') }}</h5>
                                       @endif
                                   </div>
                                   <p>{{ __('front.in_ad') }}
                                       {{ $bid->job->title ?? __('front.title_not_available') }}
                                   </p>
                               </div>
                           </a>
                       </li>
                   </ul>
               @endforeach
           @endif
           
            </div>

            <!-- Message Content -->
            @if ($selectedConversation)
                <div class="dash-msg-content chat-content">
                    @foreach (array_reverse($selectedConversation->messages->toArray()) as $message)
                        @if ($message['user_id'] === auth()->user()->id)
                            <!-- Poruka koju ste poslali -->
                            <div class="message-plunch me">
                                <div class="dash-msg-avatar">
                                    @if (auth()->user()->image)
                                        <img src="{{ auth()->user()->image }}" alt="{{ auth()->user()->name }}">
                                    @else
                                        <img src="https://via.placeholder.com/500x500" alt="">
                                    @endif
                                </div>
                                <div class="dash-msg-text">
                                    <p>{{ $message['body'] }}</p>
                                </div>
                            </div>
                        @else
                            <!-- Poruka koju je poslao korisnik -->
                            <div class="message-plunch">
                                <div class="dash-msg-avatar">
                                    @if ($message['user']['image'])
                                        <img src="{{ $message['user']['image'] }}"
                                            alt="{{ $message['user']['name'] }}">
                                    @else
                                        <img src="https://via.placeholder.com/500x500" alt="">
                                    @endif
                                </div>
                                <div class="dash-msg-text">
                                    <p>{{ $message['body'] }}</p>
                                </div>
                            </div>
                        @endif
                    @endforeach


                    <!-- Forma za slanje poruke -->
                    <div class="message-reply">
                        <form wire:submit.prevent="sendMessage">
                            <div class="emoji-picker-container">
                                <button type="button" wire:click="toggleEmojiPicker">😊</button>
                                <div class="emoji-picker {{ $showEmojiPicker ? 'active' : '' }}">
                                    <emoji-picker></emoji-picker>
                                </div>
                                <textarea wire:model="newMessage" cols="40" rows="3" class="form-control with-light"
                                    placeholder="{{ __('front.your_message_here') }}"></textarea>
                            </div>
                            <button type="submit" class="btn dark-2"
                                @unless ($newMessage) disabled @endunless>{{ __('front.send_message') }}</button>

                        </form>
                    </div>
                </div>
            @endif


        </div>
    </div>
</div>
