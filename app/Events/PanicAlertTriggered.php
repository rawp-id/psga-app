<?php

namespace App\Events;

use App\Models\PanicAlert;
use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow; // Pakai yang 'Now'
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PanicAlertTriggered implements ShouldBroadcastNow
{
    use Dispatchable, SerializesModels;

    public $alert;

    public function __construct(PanicAlert $alert)
    {
        // Load relasi user agar nama pelapor terbawa ke Pusher
        $this->alert = $alert->load('user');
    }

    public function broadcastOn()
    {
        // Channel tempat admin mendengarkan
        return new Channel('emergency-channel');
    }

    public function broadcastAs()
    {
        return 'panic.triggered';
    }
}
