<?php

namespace App\Inspections;

use App\Inspections\Inspections;

class KeyHeldDown implements Inspections
{
    public function detect($body)
    {
        return !preg_match('/(.)\\1{4,}/', $body);  
    }
}