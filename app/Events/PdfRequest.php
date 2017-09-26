<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class PdfRequest
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    protected $route;
    protected $filename;
    protected $category;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($filename, $route, $category = null)
    {
        $this->filename = $filename;
        $this->route = $route;
        $this->category = $category;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }

    public function getFilename()
    {
        return $this->filename;
    }

    public function getRoute()
    {
        return $this->route;
    }

    public function getCategory()
    {
        if(is_null($this->category)) {
            return false;
        }
        return $this->category;
    }
}
