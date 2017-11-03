<?php

namespace App\Inspections;

use App\Inspections\Inspections;

class DoublePosts implements Inspections
{
    public function detect($body, $model)
    {
       $lastPostBody = auth()->user()->$model()->latest()->take(1)->get();

       return $lastPostBody[0]->body == $body ? false : true;
    }
}