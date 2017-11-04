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
    protected $category = null;
    protected $search = null;
    protected $dateRange = null;
    protected $id = null;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($filename, $route, $data = [])
    {
        $this->filename = $filename;
        $this->route = $route;
        $this->dateRange = $data['dateRange'];
        if(array_key_exists('category', $data)) {
            $this->category = $data['category'];
        }
        if(array_key_exists('search', $data)) {
            $this->search = $data['search'];
        }
        if(array_key_exists('id', $data)) {
            $this->id = $data['id'];
        }
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

    public function getSearch()
    {
        if(is_null($this->search)) {
            return false;
        }
        return $this->search;
    }

    public function getId()
    {
        if(is_null($this->id)) {
            return false;
        }
        return $this->id;
    }

    public function getDateRange()
    {
        return $this->dateRange;
    }

}
