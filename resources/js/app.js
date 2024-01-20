/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import Echo from "laravel-echo"



window.Echo = new Echo({
    broadcaster: 'pusher',
    key: '78b74dc86ffe9b691778',
    cluster: 'eu',
    encrypted: true
});

window.Echo.channel('conversation.' + conversationId)
    .listen('NewMessage', (e) => {
        window.livewire.emit('messageReceived', e.message);
    });

