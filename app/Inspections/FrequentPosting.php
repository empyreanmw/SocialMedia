<?php

namespace App\Inspections;

use App\Inspections\Inspections;
use Carbon\Carbon;

class FrequentPosting
{
    static function detect()
    {
        $counter = 0;
        $latestReplies = auth()->user()->replies()->where('replied_type', 'App\Post')->latest()->take(3)->get();

       foreach($latestReplies as $reply)
       {
         if ($reply->created_at->diffInSeconds(Carbon::now())<30)
         {
            $counter++;

            if($counter == 3)
            {
                return false;
            }
         }
       }
       
       return true;
    }
}