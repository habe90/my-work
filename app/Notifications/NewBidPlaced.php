<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewBidPlaced extends Notification
{
    use Queueable;

    protected $bid;

    public function __construct(Bid $bid)
    {
        $this->bid = $bid;
    }

    /**
     * Dobijanje kanala slanja notifikacije.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Reprezentacija notifikacije u mailu.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('Neues Angebot platziert') // Naslov emaila
                    ->greeting('Hallo!') // Pozdrav
                    ->line('Ein neues Angebot wurde auf Ihre Ausschreibung abgegeben.') // Uvod u notifikaciju
                    ->action('Angebot ansehen', url('/')) // Tekst i URL dugmeta
                    ->line('Vielen Dank, dass Sie unsere Anwendung nutzen!') // Završna linija
                    ->salutation('Mit freundlichen Grüßen, Ihr My Work Team'); // Završetak sa potpisom
    }

    /**
     * Reprezentacija notifikacije kao niz.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            // ...
        ];
    }
}
