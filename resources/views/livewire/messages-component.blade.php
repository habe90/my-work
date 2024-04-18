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
                                    <div class="dash-msg-avatar"><img src="https://via.placeholder.com/500x500"
                                            alt="">
                                        <span
                                            class="_user_status {{ $this->isUserOnline(optional(optional($conversation->bids->first())->user)->id) ? 'online' : 'offline' }}"></span>



                                    </div>

                                    <div class="message-by">
                                        <div class="message-by-headline">
                                            @if ($conversation->bids->isNotEmpty() && optional($conversation->bids->first())->user)
                                                <h5>{{ $conversation->bids->first()->user->name }}</h5>
                                                <span>{{ $conversation->bids->first()->created_at->diffForHumans() }}</span>
                                            @else
                                                <h5>{{ __('front.user_not_available') }}</h5>
                                            @endif

                                        </div>
                                        <p>{{ __('front.in_ad') }}
                                            {{ optional(optional($conversation->bids->first())->job)->title ?? __('front.title_not_available') }}
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
                            <div class="input-group">
                                <button type="button" wire:click="toggleEmojiPicker" class="btn emoji-button">😊</button>
                                
                                <input type="file" wire:model="fileUpload" id="fileUpload" class="file-input">
                                <label for="fileUpload" class="btn file-upload-label">{{ __('front.upload_file') }}</label>
                                
                                <textarea wire:model="newMessage" class="form-control with-light" placeholder="{{ __('front.your_message_here') }}"></textarea>
                                
                                <button type="submit" class="btn send-button" @unless ($newMessage) disabled @endunless>{{ __('front.send_message') }}</button>
                            </div>
                        </form>
                    </div>
                    
                </div>
            @endif


        </div>
    </div>
</div>
<style>
    .message-reply .input-group {
    display: flex;
    align-items: center;
}

.message-reply .emoji-button {
    margin-right: 5px;
}

.message-reply .file-input {
    display: none; /* Skriva input ali dozvoljava labeli da bude vidljiva */
}

.message-reply .file-upload-label {
    margin-right: 5px;
    cursor: pointer; /* Pokazuje pokazivač kad miš pređe preko labele */
}

.message-reply .form-control {
    margin-right: 5px;
    flex-grow: 1; /* Textarea će popuniti preostali prostor */
}

.message-reply .send-button {
    white-space: nowrap; /* Sprečava prelamanje teksta na dugmetu */
}

</style>
