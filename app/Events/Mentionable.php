<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class Mentionable
{
    use Dispatchable, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */

    public $model;
    public $post;

    public function __construct($model, $post=null)
    {
        $this->model = $model->load('owner');
        $this->post = $post;
    }

}
