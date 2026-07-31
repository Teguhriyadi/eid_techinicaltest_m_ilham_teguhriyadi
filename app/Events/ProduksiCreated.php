<?php

namespace App\Events;

use App\Models\ProduksiLog;
use Illuminate\Broadcasting\Channel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;

class ProduksiCreated implements ShouldBroadcastNow
{
    use Dispatchable, SerializesModels;

    public $produksi;


    public function __construct(ProduksiLog $produksi)
    {
        $this->produksi = $produksi;
    }


    public function broadcastOn()
    {
        return new Channel('dashboard');
    }


    public function broadcastAs()
    {
        return 'produksi.created';
    }
}