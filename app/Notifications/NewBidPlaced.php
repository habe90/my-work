<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Bid;

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
    // Kriptujte job_id prije nego što ga dodate u URL
    $encryptedJobId = myCryptie($this->bid->job_id, 'encode');

    return (new MailMessage)
        ->subject('Neues Angebot eingegangen')
        ->greeting('Hallo!')
        ->line('Es wurde ein neues Angebot für Ihren Auftrag abgegeben.')
        ->action('Angebot anzeigen', url('/jobs/'.$encryptedJobId))
        ->line('Vielen Dank, dass Sie unsere Plattform nutzen!')
        ->salutation('Mit freundlichen Grüßen, Ihr Team von My Work');
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
