<?php

namespace App\Listeners;

use App\Events\Mentionable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Utilities\wordSearch;
use App\User;
use App\Notifications\YouWereMentioned;

class NotifyMentionedUsers
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Metionable  $event
     * @return void
     */
    public function handle(Mentionable $event)
    {
        $words = wordSearch::get($event->model->body, '@');
        
        foreach ($words as $word) {
           if($user = User::where('name', $word)->first())
            {      
                $user->notify(new YouWereMentioned($event->model, $event->post));
            }
        }
    }
}
