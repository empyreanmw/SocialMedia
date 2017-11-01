<?php

namespace App\Inspections;
use App\Inspections\InvalidKeywords;

class Spam
{
    protected $detections = [
        InvalidKeywords::class,
        KeyHeldDown::class
    ];

    public function check($body)
    {
        foreach ($this->detections as $detection)
        {
          $detection = new $detection();

          if($detection->detect($body) == false)
          {
            return false;
          }
          
        }

        return true;
    }
}